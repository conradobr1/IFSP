<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Gerenciador de Tarefas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" id="hojeMenu">Hoje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="novaMenu">Nova</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="todasMenu">Todas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Total: <span id="totalCount">0</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div class="row mb-4" id="formContainer">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Nova Tarefa</h5>
                    </div>
                    <div class="card-body">
                        <form id="taskForm">
                            <div class="mb-3">
                                <label for="taskName" class="form-label">Nome da Tarefa</label>
                                <input type="text" class="form-control" id="taskName" required>
                            </div>
                            <div class="mb-3">
                                <label for="taskDate" class="form-label">Data da Tarefa</label>
                                <input type="date" class="form-control" id="taskDate" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar Tarefa</button>
                            <button type="button" id="cancelButton" class="btn btn-secondary ms-2">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="mb-4" id="sectionTitle">Tarefas de Hoje</h2>
        
        <div class="row" id="tasksContainer">
        </div>

        <div class="row" id="emptyState">
            <div class="col-12 text-center py-5">
                <h4 class="text-muted mt-3">Nenhuma tarefa encontrada</h4>
                <p class="text-muted">Clique em "Nova" no menu para adicionar uma tarefa.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
        const taskForm = document.getElementById('taskForm');
        const taskNameInput = document.getElementById('taskName');
        const taskDateInput = document.getElementById('taskDate');
        const tasksContainer = document.getElementById('tasksContainer');
        const emptyState = document.getElementById('emptyState');
        const formContainer = document.getElementById('formContainer');
        const cancelButton = document.getElementById('cancelButton');
        const totalCountElement = document.getElementById('totalCount');
        const sectionTitle = document.getElementById('sectionTitle');
        const hojeMenu = document.getElementById('hojeMenu');
        const novaMenu = document.getElementById('novaMenu');
        const todasMenu = document.getElementById('todasMenu');
        let currentView = 'hoje';
        
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            taskDateInput.value = today;
            updateTotalCount();
            loadTasks(currentView);
            
            hojeMenu.addEventListener('click', function(e) {
                e.preventDefault();
                setActiveMenu('hoje');
                loadTasks('hoje');
            });
            
            novaMenu.addEventListener('click', function(e) {
                e.preventDefault();
                setActiveMenu('nova');
                formContainer.style.display = 'block';
                tasksContainer.innerHTML = '';
                emptyState.style.display = 'none';
                sectionTitle.textContent = 'Nova Tarefa';
            });
            
            todasMenu.addEventListener('click', function(e) {
                e.preventDefault();
                setActiveMenu('todas');
                loadTasks('todas');
            });
            
            taskForm.addEventListener('submit', function(e) {
                e.preventDefault();
                addTask(taskNameInput.value, taskDateInput.value);
                taskNameInput.value = '';
                taskDateInput.value = today;
                setActiveMenu('hoje');
                loadTasks('hoje');
            });
            
            cancelButton.addEventListener('click', function() {
                formContainer.style.display = 'none';
                setActiveMenu('hoje');
                loadTasks('hoje');
            });
            
            formContainer.style.display = 'none';
        });
        
        function setActiveMenu(menu) {
            hojeMenu.classList.remove('active');
            novaMenu.classList.remove('active');
            todasMenu.classList.remove('active');
            
            if (menu === 'hoje') hojeMenu.classList.add('active');
            if (menu === 'nova') novaMenu.classList.add('active');
            if (menu === 'todas') todasMenu.classList.add('active');
            
            currentView = menu;
        }
        
        function addTask(name, date) {
            tasks.push({ name, date, completed: false });
            localStorage.setItem('tasks', JSON.stringify(tasks));
            updateTotalCount();
        }
        
        function deleteTask(index) {
            tasks.splice(index, 1);
            localStorage.setItem('tasks', JSON.stringify(tasks));
            updateTotalCount();
            loadTasks(currentView);
        }
        
        function updateTotalCount() {
            totalCountElement.textContent = tasks.length;
        }
        //Conrado
        function loadTasks(view) {
            formContainer.style.display = 'none';
            tasksContainer.innerHTML = '';
            
            let filteredTasks = [];
            
            if (view === 'hoje') {
                const today = new Date().toISOString().split('T')[0];
                filteredTasks = tasks.filter(task => task.date === today);
                sectionTitle.textContent = 'Tarefas de Hoje';
            } else if (view === 'todas') {
                filteredTasks = tasks;
                sectionTitle.textContent = 'Todas as Tarefas';
            }
            
            if (filteredTasks.length === 0) {
                emptyState.style.display = 'block';
            } else {
                emptyState.style.display = 'none';
                filteredTasks.forEach((task, index) => {
                    const taskIndex = tasks.findIndex(t => t === task);
                    const card = document.createElement('div');
                    card.className = 'col-md-4 mb-3';
                    card.innerHTML = `
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${task.name}</h5>
                                <p class="card-text">Data: ${formatDate(task.date)}</p>
                                <button class="btn btn-danger btn-sm" onclick="deleteTask(${taskIndex})">Excluir</button>
                            </div>
                        </div>
                    `;
                    tasksContainer.appendChild(card);
                });
            }
        }
        
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('pt-BR');
        }
    </script>
</body>
</html>