import 'package:flutter/material.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  final letras = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];

  MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: Scaffold(
        body: Column(
          children: [
            ...letras.map((letra) {
              return ElevatedButton(
                onPressed: () {},
                child: Text(letra),
              );
            }),
          ],
        ),
      ),
    );
  }
}
