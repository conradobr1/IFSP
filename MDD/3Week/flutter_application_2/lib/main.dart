import 'package:flutter/material.dart';
import 'package:flutter_application_2/janela1.dart';
import 'package:flutter_application_2/janela2.dart';

void main() {
  runApp(const Controle());
}

class Controle extends StatefulWidget {
  const Controle({super.key});

  @override
  State<Controle> createState() => _ControleState();
}

class _ControleState extends State<Controle> {
  String janela = 'um';

  void mudaParaDois() {
    setState(() {
      janela = 'dois';
    });
  }

  void mudaParaUm() {
    setState(() {
      janela = 'um';
    });
  }

  @override
  Widget build(BuildContext context) {
    Widget atual;

    if (janela == 'um') {
      atual = Janela1(mudaParaDois);
    } else {
      atual = Janela2(mudaParaUm);
    }

    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: atual,
    );
  }
}
