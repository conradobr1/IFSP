import 'dart:io';

import 'package:flutter/material.dart';
import 'package:sqflite_common_ffi/sqflite_ffi.dart';
import 'helper.dart';

void main() {
  WidgetsFlutterBinding.ensureInitialized();
  if (Platform.isWindows || Platform.isLinux) {
    sqfliteFfiInit();
    databaseFactory = databaseFactoryFfi;
  }
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: DefaultTabController(
        length: 4,
        child: Scaffold(
          appBar: AppBar(
            title: const Text('Cadastro de Pets'),
            bottom: const TabBar(
              isScrollable: true,
              tabs: [
                Tab(text: 'Salvar'),
                Tab(text: 'Listar'),
                Tab(text: 'Atualizar'),
                Tab(text: 'Apagar'),
              ],
            ),
          ),
          body: const TabBarView(
            children: [
              SalvarAba(),
              ListarAba(),
              AtualizarAba(),
              ApagarAba(),
            ],
          ),
        ),
      ),
    );
  }
}

void mensagem(BuildContext context, String texto) {
  ScaffoldMessenger.of(context)
    ..hideCurrentSnackBar()
    ..showSnackBar(SnackBar(content: Text(texto)));
}

class SalvarAba extends StatefulWidget {
  const SalvarAba({super.key});

  @override
  State<SalvarAba> createState() => _SalvarAbaState();
}

class _SalvarAbaState extends State<SalvarAba> {
  final nome = TextEditingController();
  final idade = TextEditingController();
  bool ocupada = false;

  Future<void> salvar() async {
    final nomeDigitado = nome.text.trim();
    final idadeDigitada = int.tryParse(idade.text.trim());
    if (nomeDigitado.isEmpty || idadeDigitada == null || idadeDigitada < 0) {
      mensagem(context, 'Digite nome e idade válidos.');
      return;
    }
    setState(() => ocupada = true);
    try {
      await DatabaseHelper.salvar(nomeDigitado, idadeDigitada);
      if (!mounted) return;
      nome.clear();
      idade.clear();
      mensagem(context, 'Pet salvo com sucesso!');
    } catch (e) {
      if (mounted) mensagem(context, 'Erro ao salvar: $e');
    } finally {
      if (mounted) setState(() => ocupada = false);
    }
  }

  @override
  void dispose() {
    nome.dispose();
    idade.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return ListView(
      padding: const EdgeInsets.all(8),
      children: [
        TextField(
          controller: nome,
          decoration: const InputDecoration(
            labelText: 'Nome do pet',
            border: OutlineInputBorder(),
          ),
        ),
        const SizedBox(height: 16),
        TextField(
          controller: idade,
          keyboardType: TextInputType.number,
          decoration: const InputDecoration(
            labelText: 'Idade do pet',
            border: OutlineInputBorder(),
          ),
        ),
        const SizedBox(height: 16),
        Center(
          child: ElevatedButton(
            onPressed: ocupada ? null : salvar,
            child: const Text('Salvar'),
          ),
        ),
      ],
    );
  }
}

class ListarAba extends StatefulWidget {
  const ListarAba({super.key});

  @override
  State<ListarAba> createState() => _ListarAbaState();
}

class _ListarAbaState extends State<ListarAba> {
  late Future<List<Map<String, dynamic>>> pets;

  @override
  void initState() {
    super.initState();
    pets = DatabaseHelper.listar();
  }

  void recarregar() {
    setState(() => pets = DatabaseHelper.listar());
  }

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        ElevatedButton(
          onPressed: recarregar,
          child: const Text('Atualizar lista'),
        ),
        Expanded(
          child: FutureBuilder<List<Map<String, dynamic>>>(
            future: pets,
            builder: (context, snapshot) {
              if (snapshot.connectionState != ConnectionState.done) {
                return const Center(child: CircularProgressIndicator());
              }
              if (snapshot.hasError) {
                return Center(child: Text('Erro: ${snapshot.error}'));
              }
              final dados = snapshot.data ?? [];
              if (dados.isEmpty) {
                return const Center(child: Text('Nenhum pet cadastrado.'));
              }
              return ListView.builder(
                itemCount: dados.length,
                itemBuilder: (context, index) {
                  final pet = dados[index];
                  return ListTile(
                    title: Text('Pet: ${pet['nome']}'),
                    subtitle: Text('ID: ${pet['id']} | Idade: ${pet['idade']}'),
                  );
                },
              );
            },
          ),
        ),
      ],
    );
  }
}

class AtualizarAba extends StatefulWidget {
  const AtualizarAba({super.key});

  @override
  State<AtualizarAba> createState() => _AtualizarAbaState();
}

class _AtualizarAbaState extends State<AtualizarAba> {
  final id = TextEditingController();
  final nome = TextEditingController();
  final idade = TextEditingController();
  bool ocupada = false;

  Future<void> atualizar() async {
    final numero = int.tryParse(id.text.trim());
    final novaIdade = int.tryParse(idade.text.trim());
    final novoNome = nome.text.trim();
    if (numero == null || numero <= 0 || novoNome.isEmpty ||
        novaIdade == null || novaIdade < 0) {
      mensagem(context, 'Digite ID, nome e idade válidos.');
      return;
    }
    setState(() => ocupada = true);
    try {
      final linhas = await DatabaseHelper.atualizar(numero, novoNome, novaIdade);
      if (!mounted) return;
      mensagem(context, linhas == 0 ? 'ID não encontrado.' : 'Pet atualizado!');
      if (linhas > 0) {
        id.clear();
        nome.clear();
        idade.clear();
      }
    } catch (e) {
      if (mounted) mensagem(context, 'Erro ao atualizar: $e');
    } finally {
      if (mounted) setState(() => ocupada = false);
    }
  }

  @override
  void dispose() {
    id.dispose();
    nome.dispose();
    idade.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return ListView(
      padding: const EdgeInsets.all(8),
      children: [
        TextField(
          controller: id,
          keyboardType: TextInputType.number,
          decoration: const InputDecoration(
            labelText: 'ID do pet', border: OutlineInputBorder(),
          ),
        ),
        const SizedBox(height: 16),
        TextField(
          controller: nome,
          decoration: const InputDecoration(
            labelText: 'Novo nome', border: OutlineInputBorder(),
          ),
        ),
        const SizedBox(height: 16),
        TextField(
          controller: idade,
          keyboardType: TextInputType.number,
          decoration: const InputDecoration(
            labelText: 'Nova idade', border: OutlineInputBorder(),
          ),
        ),
        const SizedBox(height: 16),
        Center(
          child: ElevatedButton(
            onPressed: ocupada ? null : atualizar,
            child: const Text('Atualizar'),
          ),
        ),
      ],
    );
  }
}

class ApagarAba extends StatefulWidget {
  const ApagarAba({super.key});

  @override
  State<ApagarAba> createState() => _ApagarAbaState();
}

class _ApagarAbaState extends State<ApagarAba> {
  final id = TextEditingController();
  bool ocupada = false;

  Future<void> apagar() async {
    final numero = int.tryParse(id.text.trim());
    if (numero == null || numero <= 0) {
      mensagem(context, 'Digite um ID válido.');
      return;
    }
    setState(() => ocupada = true);
    try {
      final linhas = await DatabaseHelper.apagar(numero);
      if (!mounted) return;
      mensagem(context, linhas == 0 ? 'ID não encontrado.' : 'Pet apagado!');
      if (linhas > 0) id.clear();
    } catch (e) {
      if (mounted) mensagem(context, 'Erro ao apagar: $e');
    } finally {
      if (mounted) setState(() => ocupada = false);
    }
  }

  @override
  void dispose() {
    id.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return ListView(
      padding: const EdgeInsets.all(8),
      children: [
        TextField(
          controller: id,
          keyboardType: TextInputType.number,
          decoration: const InputDecoration(
            labelText: 'ID do pet', border: OutlineInputBorder(),
          ),
        ),
        const SizedBox(height: 16),
        Center(
          child: ElevatedButton(
            onPressed: ocupada ? null : apagar,
            child: const Text('Apagar'),
          ),
        ),
      ],
    );
  }
}
