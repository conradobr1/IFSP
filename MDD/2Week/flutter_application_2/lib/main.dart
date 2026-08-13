import 'package:flutter/material.dart';

void main() {
  runApp(const MainApp());
}

class MainApp extends StatefulWidget {
  const MainApp({super.key});

  @override
  State<MainApp> createState() => _MainAppState();
}

class _MainAppState extends State<MainApp> {
  int contadorVer = 0;
  int contadorComprar = 0;

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        body: Center(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Image.asset(
                'imagens/Roblox.jpg',
                height: 500,
              ),
              const Text(
                'Roblox',
                style: TextStyle(
                  fontSize: 24,
                  fontWeight: FontWeight.bold,
                ),
              ),
              const Text(
                'Jogo Digital',
                style: TextStyle(
                  fontSize: 18,
                ),
              ),
              const SizedBox(height: 20),
              Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  TextButton(
                    style: TextButton.styleFrom(
                      foregroundColor: Colors.green,
                    ),
                    onPressed: () {
                      setState(() {
                        contadorVer++;
                      });

                      print('Botão Ver clicado');
                      print(
                          'Quantidade de vezes que Ver foi clicado: $contadorVer');
                    },
                    child: const Text('Ver'),
                  ),
                  Text(
                    '$contadorVer',
                    style: const TextStyle(
                      fontSize: 18,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                  const SizedBox(width: 30),
                  TextButton(
                    onPressed: () {
                      setState(() {
                        contadorComprar++;
                      });

                      print('Botão Comprar clicado');
                      print(
                        'Quantidade de vezes que Comprar foi clicado: $contadorComprar',
                      );
                    },
                    child: const Text('Comprar'),
                  ),
                  Text(
                    '$contadorComprar',
                    style: const TextStyle(
                      fontSize: 18,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ],
              ),
            ],
          ),
        ),
      ),
    );
  }
}
