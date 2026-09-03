class Pergunta {
  final String texto;
  final List<String> respostas;

  Pergunta({
    required this.texto,
    required this.respostas,
  });

  List<String> embaralha() {
    final listaEmbaralhada = List<String>.from(respostas);
    listaEmbaralhada.shuffle();
    return listaEmbaralhada;
  }
}
