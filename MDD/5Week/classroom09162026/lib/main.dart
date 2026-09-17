import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

import 'frase_controle.dart';

void main() {
  runApp(const Janela());
}

class Janela extends StatelessWidget {
  const Janela({super.key});

  @override
  Widget build(BuildContext context) {
    return const MaterialApp(
      home: Scaffold(body: Principal()),
    );
  }
}

class Principal extends StatefulWidget {
  const Principal({super.key});

  @override
  State<Principal> createState() => _PrincipalState();
}

class _PrincipalState extends State<Principal> {
  FraseControle controle = FraseControle();
  final controlaTexto = TextEditingController();
  String textoSalvo = '';

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(16.0),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          // Prática 13: fonte Montserrat (frase) e Ms Madi (autor)
          Text(
            controle.fraseAtual.texto,
            style: GoogleFonts.montserrat(
              fontSize: 28,
              fontWeight: FontWeight.bold,
            ),
            textAlign: TextAlign.center,
          ),
          const SizedBox(height: 16),

          // Prática 8: ícone de like
          GestureDetector(
            onTap: () {
              setState(() {
                controle.fraseAtual.mudaLike();
              });
            },
            child: Icon(
              controle.fraseAtual.liked
                  ? Icons.favorite
                  : Icons.favorite_border,
              color: Colors.red,
              size: 32,
            ),
          ),
          const SizedBox(height: 16),

          // Prática 13: fonte Ms Madi, tamanho 18
          Text(
            controle.fraseAtual.autor,
            style: GoogleFonts.msMadi(fontSize: 18),
          ),
          const SizedBox(height: 24),

          ElevatedButton(
            onPressed: () {
              setState(() {
                controle.proximaFrase();
              });
            },
            child: const Text('Próxima'),
          ),
          const SizedBox(height: 24),

          // Prática 15/16: TextField com ícone
          TextField(
            controller: controlaTexto,
            decoration: const InputDecoration(
              border: OutlineInputBorder(),
              hintText: 'Comente...',
              prefixIcon: Icon(Icons.comment),
            ),
          ),
          const SizedBox(height: 16),

          ElevatedButton(
            onPressed: () {
              setState(() {
                textoSalvo = controlaTexto.text;
              });
            },
            child: const Text('Salvar'),
          ),
          const SizedBox(height: 16),

          // Prática 18: mostra o texto digitado
          Text(
            textoSalvo,
            style: const TextStyle(fontSize: 16),
          ),
        ],
      ),
    );
  }
}
