import 'dart:math';
import 'package:flutter/material.dart';

void main() {
  runApp(const JogoAdivinhacaoApp());
}

class JogoAdivinhacaoApp extends StatelessWidget {
  const JogoAdivinhacaoApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Jogo de Adivinhação',
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.deepPurple),
        useMaterial3: true,
      ),
      home: const JogoAdivinhacaoPage(),
    );
  }
}

class JogoAdivinhacaoPage extends StatefulWidget {
  const JogoAdivinhacaoPage({super.key});

  @override
  State<JogoAdivinhacaoPage> createState() => _JogoAdivinhacaoPageState();
}

class _JogoAdivinhacaoPageState extends State<JogoAdivinhacaoPage> {
  final TextEditingController _controller = TextEditingController();
  String _mensagem = '';
  Color _corMensagem = Colors.black;

  void _verificarPalpite() {
    final int? palpite = int.tryParse(_controller.text);

    if (palpite == null || palpite < 1 || palpite > 5) {
      setState(() {
        _mensagem = 'Por favor, digite um número válido de 1 a 5!';
        _corMensagem = Colors.orange;
      });
      return;
    }

    final int numeroSorteado = Random().nextInt(5) + 1;

    setState(() {
      if (palpite == numeroSorteado) {
        _mensagem = '🎉 Parabéns! Você acertou! O número era $numeroSorteado.';
        _corMensagem = Colors.green;
      } else {
        _mensagem = '❌ Errou! O número sorteado foi $numeroSorteado.';
        _corMensagem = Colors.red;
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Jogo de Adivinhação'),
        centerTitle: true,
      ),
      body: Padding(
        padding: const EdgeInsets.all(24.0),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            const Text(
              'Adivinhe o número!',
              style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
            ),
            const SizedBox(height: 8),
            const Text(
              'Escolha um número entre 1 e 5:',
              style: TextStyle(fontSize: 16),
            ),
            const SizedBox(height: 24),
            TextField(
              controller: _controller,
              keyboardType: TextInputType.number,
              textAlign: TextAlign.center,
              decoration: const InputDecoration(
                border: OutlineInputBorder(),
                hintText: 'Digite de 1 a 5',
              ),
            ),
            const SizedBox(height: 20),
            ElevatedButton(
              onPressed: _verificarPalpite,
              child: const Text('Verificar'),
            ),
            const SizedBox(height: 30),
            if (_mensagem.isNotEmpty)
              Text(
                _mensagem,
                textAlign: TextAlign.center,
                style: TextStyle(
                  fontSize: 18,
                  fontWeight: FontWeight.bold,
                  color: _corMensagem,
                ),
              ),
          ],
        ),
      ),
    );
  }
}
