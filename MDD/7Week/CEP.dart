import 'dart:async';
import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:http/http.dart' as http;

void main() => runApp(const MyApp());

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Consulta CEP',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.blue),
        useMaterial3: true,
      ),
      home: const ConsultaCepPage(),
    );
  }
}

/// Modelo que representa o endereço retornado pelo ViaCEP
class Endereco {
  final String cep;
  final String rua;
  final String bairro;
  final String cidade;
  final String estado;

  const Endereco({
    required this.cep,
    required this.rua,
    required this.bairro,
    required this.cidade,
    required this.estado,
  });

  factory Endereco.fromJson(Map<String, dynamic> json) {
    // ViaCEP retorna "erro": true quando o CEP não existe
    if (json['erro'] == true) {
      throw Exception('CEP não encontrado.');
    }
    return Endereco(
      cep: json['cep'] ?? '',
      rua: json['logradouro'] ?? '',
      bairro: json['bairro'] ?? '',
      cidade: json['localidade'] ?? '',
      estado: json['uf'] ?? '',
    );
  }
}

/// Serviço responsável por consultar o ViaCEP
class ViaCepService {
  static const String _baseUrl = 'https://viacep.com.br/ws';

  Future<Endereco> buscarCep(String cep) async {
    // Remove tudo que não for dígito (traços, espaços, etc.)
    final cepLimpo = cep.replaceAll(RegExp(r'\D'), '');

    // Valida: precisa ter exatamente 8 dígitos
    if (cepLimpo.length != 8) {
      throw Exception('CEP inválido. Informe 8 dígitos numéricos.');
    }

    final uri = Uri.parse('$_baseUrl/$cepLimpo/json/');
    final resposta = await http.get(
      uri,
      headers: {'Accept': 'application/json'},
    );

    if (resposta.statusCode == 200) {
      final json = jsonDecode(resposta.body) as Map<String, dynamic>;
      return Endereco.fromJson(json);
    } else {
      throw Exception('Falha na consulta (status ${resposta.statusCode}).');
    }
  }
}

class ConsultaCepPage extends StatefulWidget {
  const ConsultaCepPage({super.key});

  @override
  State<ConsultaCepPage> createState() => _ConsultaCepPageState();
}

class _ConsultaCepPageState extends State<ConsultaCepPage> {
  final _controller = TextEditingController();
  final _service = ViaCepService();

  Future<Endereco>? _futuro;
  String? _erroMensagem;

  void _consultar() {
    final cep = _controller.text.trim();

    setState(() {
      _erroMensagem = null;
      _futuro = _service.buscarCep(cep);
    });
  }

  @override
  void dispose() {
    _controller.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Consulta CEP'),
        backgroundColor: Theme.of(context).colorScheme.inversePrimary,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            TextField(
              controller: _controller,
              keyboardType: TextInputType.number,
              maxLength: 9, // 8 dígitos + possível traço
              inputFormatters: [
                FilteringTextInputFormatter.allow(RegExp(r'[\d-]')),
              ],
              decoration: const InputDecoration(
                labelText: 'Digite o CEP',
                hintText: 'Ex: 01001000',
                border: OutlineInputBorder(),
                prefixIcon: Icon(Icons.location_on),
              ),
              onSubmitted: (_) => _consultar(),
            ),
            const SizedBox(height: 8),
            FilledButton.icon(
              onPressed: _consultar,
              icon: const Icon(Icons.search),
              label: const Text('Buscar'),
            ),
            const SizedBox(height: 24),
            Expanded(
              child: _futuro == null
                  ? const Center(
                      child: Text(
                        'Informe um CEP para consultar.',
                        style: TextStyle(color: Colors.grey),
                      ),
                    )
                  : FutureBuilder<Endereco>(
                      future: _futuro,
                      builder: (context, snapshot) {
                        if (snapshot.connectionState ==
                            ConnectionState.waiting) {
                          return const Center(
                              child: CircularProgressIndicator());
                        }
                        if (snapshot.hasError) {
                          return Center(
                            child: Text(
                              '${snapshot.error}',
                              style: const TextStyle(color: Colors.red),
                              textAlign: TextAlign.center,
                            ),
                          );
                        }
                        if (snapshot.hasData) {
                          return _CardEndereco(endereco: snapshot.data!);
                        }
                        return const SizedBox.shrink();
                      },
                    ),
            ),
          ],
        ),
      ),
    );
  }
}

class _CardEndereco extends StatelessWidget {
  final Endereco endereco;
  const _CardEndereco({required this.endereco});

  @override
  Widget build(BuildContext context) {
    return Card(
      elevation: 3,
      child: Padding(
        padding: const EdgeInsets.all(16),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          mainAxisSize: MainAxisSize.min,
          children: [
            _linha(Icons.markunread_mailbox, 'CEP', endereco.cep),
            const Divider(),
            _linha(Icons.streetview, 'Rua', endereco.rua),
            const Divider(),
            _linha(Icons.location_city, 'Bairro', endereco.bairro),
            const Divider(),
            _linha(Icons.apartment, 'Cidade', endereco.cidade),
            const Divider(),
            _linha(Icons.map, 'Estado', endereco.estado),
          ],
        ),
      ),
    );
  }

  Widget _linha(IconData icone, String rotulo, String valor) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 6),
      child: Row(
        children: [
          Icon(icone, size: 20),
          const SizedBox(width: 12),
          Text(
            '$rotulo: ',
            style: const TextStyle(fontWeight: FontWeight.bold),
          ),
          Expanded(child: Text(valor.isEmpty ? '—' : valor)),
        ],
      ),
    );
  }
}
