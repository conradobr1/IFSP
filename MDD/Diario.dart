import 'dart:io';
import 'package:flutter/material.dart';
import 'package:path_provider/path_provider.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return const MaterialApp(
      debugShowCheckedModeBanner: false,
      home: TelaPrincipal(),
    );
  }
}

class TelaPrincipal extends StatefulWidget {
  const TelaPrincipal({super.key});

  @override
  State<TelaPrincipal> createState() => _TelaPrincipalState();
}

class _TelaPrincipalState extends State<TelaPrincipal> {
  TextEditingController controlador = TextEditingController();

  Future<File> buscarArquivo() async {
    final diretorio = await getApplicationDocumentsDirectory();
    return File('${diretorio.path}/diário.txt');
  }

  Future<void> salvar() async {
    String texto = controlador.text.trim();

    if (texto.isEmpty) return;

    final arquivo = await buscarArquivo();
    final agora = DateTime.now();

    String data = '${agora.day.toString().padLeft(2, '0')}/'
        '${agora.month.toString().padLeft(2, '0')}/'
        '${agora.year}';

    String linha = '$data - ${texto.replaceAll('\n', ' ')}\n';

    await arquivo.writeAsString(
      linha,
      mode: FileMode.append,
      flush: true,
    );

    if (!mounted) return;

    controlador.clear();

    ScaffoldMessenger.of(context).showSnackBar(
      const SnackBar(
        content: Text('Texto salvo no diário!'),
      ),
    );
  }

  void visualizar() {
    Navigator.push(
      context,
      MaterialPageRoute(
        builder: (context) => const TelaDiario(),
      ),
    );
  }

  @override
  void dispose() {
    controlador.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Meu Diário'),
      ),
      body: Center(
        child: Column(
          children: [
            Padding(
              padding: const EdgeInsets.all(8.0),
              child: TextField(
                controller: controlador,
                maxLines: 4,
                decoration: const InputDecoration(
                  hintText: 'Digite seu texto...',
                  border: OutlineInputBorder(),
                ),
              ),
            ),
            ElevatedButton(
              onPressed: salvar,
              child: const Text('Salvar'),
            ),
            ElevatedButton(
              onPressed: visualizar,
              child: const Text('Visualizar Diário'),
            ),
          ],
        ),
      ),
    );
  }
}

class TelaDiario extends StatefulWidget {
  const TelaDiario({super.key});

  @override
  State<TelaDiario> createState() => _TelaDiarioState();
}

class _TelaDiarioState extends State<TelaDiario> {
  String diario = '';

  @override
  void initState() {
    super.initState();
    carregarDiario();
  }

  Future<void> carregarDiario() async {
    final diretorio = await getApplicationDocumentsDirectory();
    final arquivo = File('${diretorio.path}/diário.txt');

    String conteudo = '';

    if (await arquivo.exists()) {
      conteudo = await arquivo.readAsString();
    }

    if (!mounted) return;

    setState(() {
      diario = conteudo;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Visualizar Diário'),
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(16.0),
        child: Text(
          diario.isEmpty ? 'Nenhum texto salvo.' : diario,
          style: const TextStyle(fontSize: 16),
        ),
      ),
    );
  }
}
