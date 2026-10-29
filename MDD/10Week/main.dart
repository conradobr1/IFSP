import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';

void main() {
  runApp(MaterialApp(
    debugShowCheckedModeBanner: false,
    home: Tabuada(),
  ));
}

class Tabuada extends StatefulWidget {
  @override
  State<Tabuada> createState() => _TabuadaState();
}

class _TabuadaState extends State<Tabuada> {
  int fator = 1;
  int numero = 1;
  String resposta = '';

  @override
  void initState() {
    super.initState();
    carregar();
  }

  void carregar() async {
    final prefs = await SharedPreferences.getInstance();

    if (!mounted) return;

    setState(() {
      fator = prefs.getInt('fator') ?? 1;
      numero = prefs.getInt('numero') ?? 1;
    });
  }

  void salvar() async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.setInt('fator', fator);
    await prefs.setInt('numero', numero);
  }

  void verificar() {
    if (resposta.isEmpty || fator > 10) return;

    if (int.parse(resposta) == fator * numero) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(content: Text('Acertou!')),
      );

      setState(() {
        numero++;

        if (numero > 10) {
          numero = 1;
          fator++;
        }

        resposta = '';
      });

      salvar();
    } else {
      int fatorAnterior = fator;
      int numeroAnterior = numero;

      setState(() {
        fator++;
        numero = 1;
        resposta = '';
      });

      salvar();

      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Errou, clique aqui para continuar'),
          duration: Duration(seconds: 8),
          action: SnackBarAction(
            label: 'Continuar',
            onPressed: () {
              setState(() {
                fator = fatorAnterior;
                numero = numeroAnterior;
              });
              salvar();
            },
          ),
        ),
      );
    }
  }

  void apertar(String tecla) {
    if (tecla == '=') {
      verificar();
    } else if (tecla == 'C') {
      setState(() {
        resposta = '';
      });
    } else if (tecla == '⌫') {
      if (resposta.isNotEmpty) {
        setState(() {
          resposta = resposta.substring(
            0,
            resposta.length - 1,
          );
        });
      }
    } else {
      setState(() {
        if (resposta.length < 4) {
          resposta += tecla;
        }
      });
    }
  }

  Widget botao(String texto) {
    Color cor = Colors.grey.shade200;

    if (texto == '=') {
      cor = Colors.green.shade300;
    }

    if (texto == 'C' || texto == '⌫') {
      cor = Colors.orange.shade200;
    }

    return Expanded(
      child: Padding(
        padding: EdgeInsets.all(4),
        child: SizedBox(
          height: 65,
          child: ElevatedButton(
            style: ElevatedButton.styleFrom(
              backgroundColor: cor,
              foregroundColor: Colors.black,
            ),
            onPressed: () => apertar(texto),
            child: Text(
              texto,
              style: TextStyle(fontSize: 26),
            ),
          ),
        ),
      ),
    );
  }

  Widget linha(String a, String b, String c) {
    return Row(
      children: [
        botao(a),
        botao(b),
        botao(c),
      ],
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Calculadora de Tabuada'),
        backgroundColor: Colors.blue,
        foregroundColor: Colors.white,
      ),
      body: Center(
        child: SingleChildScrollView(
          padding: EdgeInsets.all(20),
          child: Column(
            children: [
              if (fator > 10) ...[
                Text(
                  'Parabéns! Você terminou!',
                  style: TextStyle(fontSize: 25),
                ),
              ] else ...[
                Text(
                  'Tabuada do $fator',
                  style: TextStyle(fontSize: 25),
                ),

                SizedBox(height: 15),

                LinearProgressIndicator(
                  value: (numero - 1) / 10,
                  minHeight: 10,
                ),

                SizedBox(height: 25),

                Text(
                  '$fator × $numero = ?',
                  style: TextStyle(
                    fontSize: 35,
                    fontWeight: FontWeight.bold,
                  ),
                ),

                SizedBox(height: 20),

                // Visor da calculadora
                Container(
                  width: double.infinity,
                  height: 75,
                  padding: EdgeInsets.all(15),
                  alignment: Alignment.centerRight,
                  decoration: BoxDecoration(
                    color: Colors.grey.shade200,
                    border: Border.all(color: Colors.black),
                    borderRadius: BorderRadius.circular(10),
                  ),
                  child: Text(
                    resposta.isEmpty ? '0' : resposta,
                    style: TextStyle(fontSize: 35),
                  ),
                ),

                SizedBox(height: 20),

                // Teclado da calculadora
                linha('7', '8', '9'),
                linha('4', '5', '6'),
                linha('1', '2', '3'),
                linha('C', '0', '⌫'),

                Row(
                  children: [
                    botao('='),
                  ],
                ),
              ],
              SizedBox(height: 20),
              ElevatedButton(
                onPressed: () {
                  setState(() {
                    fator = 1;
                    numero = 1;
                    resposta = '';
                  });
                  salvar();
                },
                child: Text('Reiniciar'),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
