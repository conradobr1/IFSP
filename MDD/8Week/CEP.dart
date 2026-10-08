import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatefulWidget {
  const MyApp({super.key});

  @override
  State<MyApp> createState() => _MyAppState();
}

class _MyAppState extends State<MyApp> {
  TextEditingController controladorCep = TextEditingController();
  TextEditingController controladorNumero = TextEditingController();

  String rua = '';
  String bairro = '';
  String cidade = '';
  String estado = '';
  String mensagem = '';
  bool carregando = false;

  @override
  void initState() {
    super.initState();
    carregarDados();
  }

  Future<void> carregarDados() async {
    final prefs = await SharedPreferences.getInstance();

    if (!mounted) return;

    setState(() {
      controladorCep.text = prefs.getString('cep') ?? '';
      controladorNumero.text = prefs.getString('numero') ?? '';
      rua = prefs.getString('rua') ?? '';
      bairro = prefs.getString('bairro') ?? '';
      cidade = prefs.getString('cidade') ?? '';
      estado = prefs.getString('estado') ?? '';
    });
  }

  Future<void> buscarCep() async {
    String cep = controladorCep.text.replaceAll(RegExp(r'\D'), '');

    if (cep.length != 8) {
      setState(() {
        mensagem = 'Digite um CEP válido!';
      });
      return;
    }

    setState(() {
      carregando = true;
      mensagem = '';
    });

    try {
      final resposta = await http.get(
        Uri.parse('https://viacep.com.br/ws/$cep/json/'),
      );

      if (resposta.statusCode == 200) {
        final dados = jsonDecode(resposta.body);

        if (!mounted) return;

        if (dados['erro'] == true) {
          setState(() {
            mensagem = 'CEP não encontrado!';
          });
        } else {
          setState(() {
            rua = dados['logradouro'] ?? '';
            bairro = dados['bairro'] ?? '';
            cidade = dados['localidade'] ?? '';
            estado = dados['uf'] ?? '';
            mensagem = 'Endereço encontrado!';
          });

          await salvarDados();
        }
      } else {
        if (!mounted) return;

        setState(() {
          mensagem = 'Erro ao consultar o CEP!';
        });
      }
    } catch (e) {
      if (!mounted) return;

      setState(() {
        mensagem = 'Erro de conexão!';
      });
    } finally {
      if (mounted) {
        setState(() {
          carregando = false;
        });
      }
    }
  }

  Future<void> salvarDados() async {
    final prefs = await SharedPreferences.getInstance();

    await prefs.setString('cep', controladorCep.text);
    await prefs.setString('numero', controladorNumero.text);
    await prefs.setString('rua', rua);
    await prefs.setString('bairro', bairro);
    await prefs.setString('cidade', cidade);
    await prefs.setString('estado', estado);

    if (!mounted) return;

    setState(() {
      mensagem = 'Dados salvos com sucesso!';
    });
  }

  Future<void> apagarDados() async {
    final prefs = await SharedPreferences.getInstance();

    await prefs.remove('cep');
    await prefs.remove('numero');
    await prefs.remove('rua');
    await prefs.remove('bairro');
    await prefs.remove('cidade');
    await prefs.remove('estado');

    if (!mounted) return;

    setState(() {
      controladorCep.clear();
      controladorNumero.clear();
      rua = '';
      bairro = '';
      cidade = '';
      estado = '';
      mensagem = 'Dados apagados!';
    });
  }

  @override
  void dispose() {
    controladorCep.dispose();
    controladorNumero.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        appBar: AppBar(
          title: const Text('Consulta de CEP'),
        ),
        body: SingleChildScrollView(
          child: Column(
            children: [
              Padding(
                padding: const EdgeInsets.all(8.0),
                child: TextField(
                  controller: controladorCep,
                  keyboardType: TextInputType.number,
                  decoration: const InputDecoration(
                    hintText: 'Digite o CEP',
                    border: OutlineInputBorder(),
                  ),
                ),
              ),
              Padding(
                padding: const EdgeInsets.all(8.0),
                child: TextField(
                  controller: controladorNumero,
                  keyboardType: TextInputType.number,
                  decoration: const InputDecoration(
                    hintText: 'Digite o número da casa',
                    border: OutlineInputBorder(),
                  ),
                ),
              ),
              ElevatedButton(
                onPressed: carregando ? null : buscarCep,
                child: const Text('Buscar CEP'),
              ),
              ElevatedButton(
                onPressed: salvarDados,
                child: const Text('Salvar'),
              ),
              ElevatedButton(
                onPressed: apagarDados,
                child: const Text('Apagar'),
              ),
              if (carregando) const CircularProgressIndicator(),
              Text('Rua: $rua'),
              Text('Número: ${controladorNumero.text}'),
              Text('Bairro: $bairro'),
              Text('Cidade: $cidade'),
              Text('Estado: $estado'),
              Text(mensagem),
            ],
          ),
        ),
      ),
    );
  }
}
