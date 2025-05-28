<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9fafb;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        h1, h2 {
            color: #2c3e50;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
        }
        li {
            background: white;
            padding: 12px 16px;
            margin-bottom: 8px;
            border-radius: 6px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        }
        form input, form select, form textarea, form button {
            padding: 10px 14px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1.5px solid #ddd;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }
        form input:focus, form select:focus, form textarea:focus {
            outline: none;
            border-color: #3490dc;
        }
        button {
            background-color: #3490dc;
            color: white;
            border: none;
            padding: 10px 18px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 15px;
        }
        button:hover {
            background-color: #2779bd;
        }
        hr {
            margin: 40px 0;
            border: 0;
            height: 1px;
            background-color: #ddd;
        }
        label {
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
        }
        .section {
            margin-bottom: 40px;
        }
        textarea {
            resize: vertical;
        }
        .project-status-form {
            display: inline-block;
            margin-left: 15px;
        }
        .project-status-form select {
            width: auto;
            padding: 5px 10px;
        }
        .project-status-form button {
            padding: 5px 10px;
            margin-left: 5px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, {{ session('user_name') }}</h1>

        <div class="section">
            <h2>Profile</h2>
            <ul>
                <li><strong>Name:</strong> {{ session('user_name') }}</li>
                <li><strong>Email:</strong> {{ session('user_email') }}</li>
            </ul>
        </div>

        <hr>

        <div class="section">
            <h2>My Clients</h2>
            <form method="POST" action="/clients">
                @csrf
                <input type="text" name="name" placeholder="Client Name" required>
                <input type="email" name="email" placeholder="Client Email" required>
                <input type="text" name="contact" placeholder="Contact Info" required>
                <button type="submit">Add Client</button>
            </form>

            <br>

            <ul>
                @forelse ($clients as $client)
                    <li>
                        <strong>{{ $client->name }}</strong> — {{ $client->email }} — {{ $client->contact }}
                    </li>
                @empty
                    <li>No clients yet.</li>
                @endforelse
            </ul>
        </div>

        <hr>

        <div class="section">
            <h2>Projects</h2>

            <form method="POST" action="/projects">
                @csrf
                <label for="client_id">Select Client</label>
                <select name="client_id" id="client_id" required>
                    <option value="">Select Client</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                </select>

                <label for="title">Project Title</label>
                <input type="text" name="title" id="title" placeholder="Project Title" required>

                <label for="description">Project Description</label>
                <textarea name="description" id="description" placeholder="Project Description" required></textarea>

                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="active" selected>Active</option>
                    <option value="completed">Completed</option>
                </select>

                <label for="deadline">Deadline</label>
                <input type="date" name="deadline" id="deadline" required>

                <button type="submit">Add Project</button>
            </form>

            <br>

            <ul>
                @foreach ($clients as $client)
                    <li>
                        <strong>{{ $client->name }}</strong>
                        <ul>
                            @foreach ($client->projects as $project)
                                <li>
                                    {{ $project->title }} — Status: <strong>{{ ucfirst($project->status) }}</strong> — Deadline: {{ $project->deadline }}

                                    <!-- Form to update status -->
                                    <form method="POST" action="/projects/{{ $project->id }}/update-status" class="project-status-form">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="active" {{ $project->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>

        <form method="POST" action="/logout">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
