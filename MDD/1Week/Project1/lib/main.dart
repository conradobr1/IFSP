import 'package:flutter/material.dart';

void main() {
  runApp(
    MaterialApp(
      home: Scaffold(
        body: Container(
          decoration: const BoxDecoration(
            gradient: LinearGradient(
              begin: Alignment.topCenter,
              end: Alignment(0.1, 1),
              colors: <Color>[
                Colors.lightBlue,
                Colors.lightGreen,
              ],
            ),
          ),
          child: const Center(
            child: Text(
              'Hello IFSP',
              style: TextStyle(
                fontSize: 30,
                color: Colors.white,
              ),
            ),
          ),
        ),
      ),
    ),
  );
}
