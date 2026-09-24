import 'package:flutter/material.dart';

void main() {
  runApp(const WikipediaImagesApp());
}

class WikipediaImagesApp extends StatelessWidget {
  const WikipediaImagesApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Imagens da Wikipédia',
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.blue),
        useMaterial3: true,
      ),
      home: const GalleryPage(),
    );
  }
}

// Modelo de uma imagem
class WikipediaImage {
  final String title;
  final String url;

  WikipediaImage({
    required this.title,
    required this.url,
  });
}

// Lista de imagens.
// As URLs são imagens públicas do Wikimedia Commons.
final List<WikipediaImage> images = [
  WikipediaImage(
    title: 'Gato',
    url: 'https://upload.wikimedia.org/wikipedia/commons/3/3a/Cat03.jpg',
  ),
  WikipediaImage(
    title: 'Cachorro',
    url: 'https://upload.wikimedia.org/wikipedia/commons/6/6e/Golde33443.jpg',
  ),
  WikipediaImage(
    title: 'Tigre',
    url: 'https://upload.wikimedia.org/wikipedia/commons/5/56/Tiger.50.jpg',
  ),
  WikipediaImage(
    title: 'Leão',
    url:
        'https://upload.wikimedia.org/wikipedia/commons/7/73/Lion_waiting_in_Namibia.jpg',
  ),
  WikipediaImage(
    title: 'Elefante',
    url:
        'https://upload.wikimedia.org/wikipedia/commons/3/37/African_Bush_Elephant.jpg',
  ),
  WikipediaImage(
    title: 'Girafa',
    url:
        'https://upload.wikimedia.org/wikipedia/commons/9/9f/Giraffe_standing.jpg',
  ),
];

// Imagens aprovadas
final List<WikipediaImage> approvedImages = [];

class GalleryPage extends StatelessWidget {
  const GalleryPage({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Imagens da Wikipédia'),
        actions: [
          IconButton(
            icon: const Icon(Icons.check_circle),
            tooltip: 'Imagens aprovadas',
            onPressed: () {
              Navigator.push(
                context,
                MaterialPageRoute(
                  builder: (context) => const ApprovedPage(),
                ),
              );
            },
          ),
        ],
      ),
      body: GridView.builder(
        padding: const EdgeInsets.all(12),
        gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
          crossAxisCount: 3,
          crossAxisSpacing: 10,
          mainAxisSpacing: 10,
          childAspectRatio: 0.85,
        ),
        itemCount: images.length,
        itemBuilder: (context, index) {
          final image = images[index];

          return GestureDetector(
            onTap: () {
              Navigator.push(
                context,
                MaterialPageRoute(
                  builder: (context) => ReviewPage(
                    image: image,
                  ),
                ),
              );
            },
            child: Card(
              clipBehavior: Clip.antiAlias,
              elevation: 3,
              child: Column(
                children: [
                  Expanded(
                    child: Image.network(
                      image.url,
                      width: double.infinity,
                      fit: BoxFit.cover,

                      // Enquanto carrega
                      loadingBuilder: (
                        context,
                        child,
                        loadingProgress,
                      ) {
                        if (loadingProgress == null) {
                          return child;
                        }

                        return const Center(
                          child: CircularProgressIndicator(),
                        );
                      },

                      // Caso dê erro ao carregar
                      errorBuilder: (context, error, stackTrace) {
                        return const Center(
                          child: Icon(
                            Icons.broken_image,
                            size: 40,
                            color: Colors.grey,
                          ),
                        );
                      },
                    ),
                  ),
                  Padding(
                    padding: const EdgeInsets.all(6),
                    child: Text(
                      image.title,
                      maxLines: 1,
                      overflow: TextOverflow.ellipsis,
                      textAlign: TextAlign.center,
                    ),
                  ),
                ],
              ),
            ),
          );
        },
      ),
    );
  }
}

// Página para aprovar ou reprovar
class ReviewPage extends StatelessWidget {
  final WikipediaImage image;

  const ReviewPage({
    super.key,
    required this.image,
  });

  void approve(BuildContext context) {
    // Evita adicionar a mesma imagem duas vezes.
    if (!approvedImages.contains(image)) {
      approvedImages.add(image);
    }

    Navigator.pop(context);
  }

  void reject(BuildContext context) {
    Navigator.pop(context);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Avaliar imagem'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(20),
        child: Column(
          children: [
            Expanded(
              child: Center(
                child: ClipRRect(
                  borderRadius: BorderRadius.circular(16),
                  child: Image.network(
                    image.url,
                    fit: BoxFit.contain,
                    width: double.infinity,
                  ),
                ),
              ),
            ),
            const SizedBox(height: 15),
            Text(
              image.title,
              style: const TextStyle(
                fontSize: 24,
                fontWeight: FontWeight.bold,
              ),
            ),
            const SizedBox(height: 25),
            Row(
              children: [
                // Botão reprovar
                Expanded(
                  child: ElevatedButton.icon(
                    onPressed: () => reject(context),
                    icon: const Icon(Icons.close),
                    label: const Text('Reprovar'),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.red,
                      foregroundColor: Colors.white,
                      padding: const EdgeInsets.symmetric(
                        vertical: 16,
                      ),
                    ),
                  ),
                ),

                const SizedBox(width: 15),

                // Botão aprovar
                Expanded(
                  child: ElevatedButton.icon(
                    onPressed: () => approve(context),
                    icon: const Icon(Icons.check),
                    label: const Text('Aprovar'),
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.green,
                      foregroundColor: Colors.white,
                      padding: const EdgeInsets.symmetric(
                        vertical: 16,
                      ),
                    ),
                  ),
                ),
              ],
            ),
            const SizedBox(height: 15),
          ],
        ),
      ),
    );
  }
}

class ApprovedPage extends StatefulWidget {
  const ApprovedPage({super.key});

  @override
  State<ApprovedPage> createState() => _ApprovedPageState();
}

class _ApprovedPageState extends State<ApprovedPage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Imagens aprovadas'),
      ),
      body: approvedImages.isEmpty
          ? const Center(
              child: Text(
                'Nenhuma imagem foi aprovada.',
                style: TextStyle(fontSize: 18),
              ),
            )
          : ListView.builder(
              padding: const EdgeInsets.all(12),
              itemCount: approvedImages.length,
              itemBuilder: (context, index) {
                final image = approvedImages[index];

                return Card(
                  margin: const EdgeInsets.only(bottom: 12),
                  child: ListTile(
                    leading: ClipRRect(
                      borderRadius: BorderRadius.circular(8),
                      child: Image.network(
                        image.url,
                        width: 70,
                        height: 70,
                        fit: BoxFit.cover,
                      ),
                    ),
                    title: Text(image.title),
                    trailing: const Icon(
                      Icons.check_circle,
                      color: Colors.green,
                    ),
                  ),
                );
              },
            ),
    );
  }
}
