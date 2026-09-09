import 'package:flutter/material.dart';
import 'package:flutter_application_2/pergunta.dart';
import 'package:flutter_application_2/questoes.dart';

import 'botao_resposta.dart';

class Janela2 extends StatefulWidget {
  const Janela2({super.key});

  @override
  State<Janela2> createState() => _Janela2State();
}

class _Janela2State extends State<Janela2> {
  int indiceQuestao = 0;

  @override
  Widget build(BuildContext context) {
    Pergunta teste1 = questoes[indiceQuestao];

    return Scaffold(
      body: Column(
        children: [
          Padding(
            padding: const EdgeInsets.all(10.0),
            child: Opacity(
              opacity: 0.8,
              child: Image.asset(
                'assets/imagens/palhaco_ouve.png',
              ),
            ),
          ),
          Text(teste1.texto),
          const SizedBox(
            height: 10,
          ),
          ...teste1.Embaralha().map((item) {
            return BotaoReposta(
              cor: const Color.fromARGB(255, 224, 55, 47),
              callResposta: () {
                setState(() {
                  if (indiceQuestao < questoes.length - 1) {
                    indiceQuestao++;
                  }
                });
              },
              textoResposta: item,
            );
          }),
        ],
      ),
    );
  }
}
