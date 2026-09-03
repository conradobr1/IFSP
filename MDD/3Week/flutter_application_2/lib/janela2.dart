import 'package:flutter/material.dart';
import 'package:flutter_application_2/pergunta.dart';
import 'package:flutter_application_2/questoes.dart';

class Janela2 extends StatelessWidget {
  final VoidCallback mudaParaUm;

  const Janela2(
    void Function() mudaParaUm, {
    super.key,
    required this.mudaParaUm,
  });

  @override
  Widget build(BuildContext context) {
    Pergunta teste1 = questoes[1];

    return Scaffold(
      body: Column(
        children: [
          Padding(
            padding: const EdgeInsets.all(10.0),
            child: Opacity(
              opacity: 0.8,
              child: SizedBox(
                width: 150,
                height: 150,
                child: Image.asset(
                  'assets/imagens/palhaco_ouve.png',
                  fit: BoxFit.contain,
                ),
              ),
            ),
          ),
          Text(teste1.texto),
          const SizedBox(height: 10),
          ElevatedButton(
            onPressed: () {
              mudaParaUm();
            },
            child: Text(teste1.respostas[0]),
          ),
          const SizedBox(height: 10),
          ElevatedButton(
            onPressed: () {
              mudaParaUm();
            },
            child: Text(teste1.respostas[1]),
          ),
          const SizedBox(height: 10),
          ElevatedButton(
            onPressed: () {
              mudaParaUm();
            },
            child: Text(teste1.respostas[2]),
          ),
          const SizedBox(height: 10),
          ElevatedButton(
            onPressed: () {
              mudaParaUm();
            },
            child: Text(teste1.respostas[3]),
          ),
        ],
      ),
    );
  }
}
