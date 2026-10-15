import 'dart:io';

import 'package:path/path.dart';
import 'package:sqflite/sqflite.dart';
import 'package:sqflite_common_ffi/sqflite_ffi.dart';

class DatabaseHelper {
  static Database? _database;

  static Future<Database> get database async {
    if (_database != null) return _database!;
    final factory = (Platform.isWindows || Platform.isLinux)
        ? databaseFactoryFfi
        : databaseFactory;
    final caminho = join(await factory.getDatabasesPath(), 'exercicio_pets.db');
    _database = await factory.openDatabase(
      caminho,
      options: OpenDatabaseOptions(
        version: 1,
        onCreate: (db, version) async {
          await db.execute('''
            CREATE TABLE pets (
              id INTEGER PRIMARY KEY AUTOINCREMENT,
              nome TEXT NOT NULL,
              idade INTEGER NOT NULL
            )
          ''');
        },
      ),
    );
    return _database!;
  }

  static Future<int> salvar(String nome, int idade) async {
    final db = await database;
    return db.insert('pets', {'nome': nome, 'idade': idade});
  }

  static Future<List<Map<String, dynamic>>> listar() async {
    final db = await database;
    return db.query('pets', orderBy: 'id ASC');
  }

  static Future<int> atualizar(int id, String nome, int idade) async {
    final db = await database;
    return db.update('pets', {'nome': nome, 'idade': idade},
        where: 'id = ?', whereArgs: [id]);
  }

  static Future<int> apagar(int id) async {
    final db = await database;
    return db.delete('pets', where: 'id = ?', whereArgs: [id]);
  }
}
