import 'dart:io';
import 'package:flutter/material.dart';
import 'package:path_provider/path_provider.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatefulWidget {
  const MyApp({super.key});

  @override
  State<MyApp> createState() => _MyAppState();
}

class _MyAppState extends State<MyApp> {
  TextEditingController controlador = TextEditingController();
  String mensagem = '';

  @override
  void initState() {
    super.initState();
    carregar();
  }

  Future<File> buscarArquivo() async {
    final diretorio = await getApplicationDocumentsDirectory();
    return File('${diretorio.path}/organiza.md');
  }

  Future<void> carregar() async {
    final arquivo = await buscarArquivo();

    if (await arquivo.exists()) {
      final texto = await arquivo.readAsString();

      if (!mounted) return;

      setState(() {
        controlador.text = texto;
      });
    }
  }

  Future<void> salvar() async {
    final arquivo = await buscarArquivo();

    await arquivo.writeAsString(
      controlador.text,
      flush: true,
    );

    if (!mounted) return;

    setState(() {
      mensagem = 'Arquivo salvo com sucesso!';
    });
  }

  Future<void> apagar() async {
    final arquivo = await buscarArquivo();

    if (await arquivo.exists()) {
      await arquivo.delete();
    }

    if (!mounted) return;

    setState(() {
      controlador.clear();
      mensagem = 'Arquivo apagado!';
    });
  }

  @override
  void dispose() {
    controlador.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        appBar: AppBar(
          title: const Text('Editor Markdown'),
        ),
        body: Padding(
          padding: const EdgeInsets.all(8.0),
          child: Column(
            children: [
              const Text('Arquivo: organiza.md'),
              const SizedBox(height: 10),
              Expanded(
                child: TextField(
                  controller: controlador,
                  expands: true,
                  maxLines: null,
                  minLines: null,
                  textAlignVertical: TextAlignVertical.top,
                  decoration: const InputDecoration(
                    hintText: 'Digite seu texto Markdown...',
                    border: OutlineInputBorder(),
                  ),
                ),
              ),
              const SizedBox(height: 10),
              Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  ElevatedButton(
                    onPressed: salvar,
                    child: const Text('Salvar'),
                  ),
                  const SizedBox(width: 10),
                  ElevatedButton(
                    onPressed: apagar,
                    child: const Text('Apagar'),
                  ),
                ],
              ),
              const SizedBox(height: 10),
              Text(mensagem),
            ],
          ),
        ),
      ),
    );
  }
}
