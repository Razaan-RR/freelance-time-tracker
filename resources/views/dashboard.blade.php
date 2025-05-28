<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, {{ session('user_name') }}</h1>

    <h2>Profile</h2>
    <ul>
        <li><strong>Name:</strong> {{ session('user_name') }}</li>
        <li><strong>Email:</strong> {{ session('user_email') }}</li>
        <li><strong>Password:</strong> {{ session('user_password') }}</li>
    </ul>

    <hr>

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

    <hr>

    <h2>Projects</h2>

    <form method="POST" action="/projects">
        @csrf
        <select name="client_id" required>
            <option value="">Select Client</option>
            @foreach ($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
            @endforeach
        </select>
        <input type="text" name="title" placeholder="Project Title" required>
        <textarea name="description" placeholder="Project Description" required></textarea>
        <select name="status" required>
            <option value="active">Active</option>
            <option value="completed">Completed</option>
        </select>
        <input type="date" name="deadline" required>
        <button type="submit">Add Project</button>
    </form>

    <br>

    <ul>
        @foreach ($clients as $client)
            <li>
                <strong>{{ $client->name }}</strong>
                <ul>
                    @forelse ($client->projects as $project)
                        <li>
                            <strong>{{ $project->title }}</strong> —
                            {{ $project->description }} —
                            <form method="POST" action="/projects/{{ $project->id }}/status" style="display:inline;">
                                @csrf
                                <select name="status" onchange="this.form.submit()">
                                    <option value="active" {{ $project->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </form>
                            — {{ $project->deadline }}
                        </li>
                    @empty
                        <li>No projects for this client.</li>
                    @endforelse
                </ul>
            </li>
        @endforeach
    </ul>

    <hr>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
