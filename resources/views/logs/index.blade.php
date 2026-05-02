<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Logbook</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

   <style>
        @media print {
            .no-print { display: none !important; }
            #kanban-view { display: none !important; }
            #table-view { display: block !important; }
            body { padding: 0; margin: 0; background: white; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid black; padding: 15px; text-align: left; font-family: serif; }
        }
    </style>

    <!-- Add this to your <head> section -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        border: "hsl(214.3 31.8% 91.4%)",
                        input: "hsl(214.3 31.8% 91.4%)",
                        background: "hsl(0 0% 100%)",
                        foreground: "hsl(222.2 84% 4.9%)",
                        primary: "hsl(222.2 47.4% 11.2%)",
                        "primary-foreground": "hsl(210 40% 98%)",
                        muted: "hsl(210 40% 96.1%)",
                        "muted-foreground": "hsl(215.4 16.3% 46.9%)",
                        accent: "hsl(210 40% 96.1%)",
                        card: "hsl(0 0% 100%)",
                        ongoing: "hsl(48 96% 89%)",
                        "ongoing-foreground": "hsl(38 92% 50%)",
                        completed: "hsl(143 85% 96%)",
                        "completed-foreground": "hsl(140 71% 45%)",
                        stuck: "hsl(0 100% 97%)",
                        "stuck-foreground": "hsl(0 84% 60%)",
                    }
                }
            }
        }
    </script>
    
</head>


<body>

<!-- Top Right Controls -->
    <div class="absolute top-6 right-8 flex items-center gap-6 no-print">
        <!-- Link to Breeze's built-in Profile Settings -->
        <a href="/profile" class="text-sm font-medium text-muted-foreground hover:text-foreground transition">
            ⚙️ Settings
        </a>
        
        <!-- Secure Logout Form -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800 transition">
                Log Out
            </button>
        </form>
    </div>

    <!-- THE TRANSLATED LOVABLE KANBAN UI -->
<div class="min-h-screen bg-gray-50 text-foreground font-sans">
    <div class="mx-auto max-w-7xl px-6 py-10 lg:px-10 lg:py-14">

        <!-- VIEW CONTROLS -->
        <div class="no-print mb-8 flex justify-center gap-4">
            <button onclick="switchView('kanban')" class="rounded-full bg-primary px-6 py-2 text-sm font-medium text-primary-foreground hover:opacity-90">Kanban Board</button>
            <button onclick="switchView('table')" class="rounded-full border border-border bg-card px-6 py-2 text-sm font-medium text-foreground shadow-sm hover:bg-gray-50">Official Table View</button>
            <button onclick="window.print()" class="rounded-full bg-black px-6 py-2 text-sm font-medium text-white shadow-sm hover:bg-gray-800">🖨️ Print Logbook</button>
        </div>
        
        <!-- Header Section -->
       <!-- Dynamic Header (Split Layout) -->
        <div class="mb-12 no-print flex flex-col sm:flex-row sm:justify-between sm:items-start gap-8">
            
            <!-- Left Side: The Text -->
            <div class="text-center sm:text-left">
                <!-- Dynamic Company Name -->
                <div class="inline-flex items-center gap-2 text-xs font-medium uppercase tracking-[0.18em] text-muted-foreground mb-4 justify-center sm:justify-start">
                    <span class="h-px w-8 bg-foreground/30"></span>
                    {{ Auth::user()->company_name ? strtoupper(Auth::user()->company_name) : 'INTERNSHIP LOGBOOK' }}
                </div>
                
                <h1 class="text-4xl sm:text-5xl font-medium tracking-tight text-foreground mb-4">
                    The Daily <em class="italic text-foreground/70 font-serif">Logbook</em>.
                </h1>
                <p class="text-muted-foreground max-w-xl text-sm leading-relaxed mx-auto sm:mx-0">
                    A quiet place to track what's moving, what's done, and what needs another look.
                </p>
            </div>

            <!-- Right Side: The Logo -->
            @if(Auth::user()->company_logo)
                <div class="flex justify-center sm:justify-end shrink-0">
                    <img src="{{ asset('storage/' . Auth::user()->company_logo) }}" 
                         alt="Company Logo" 
                         class="h-24 sm:h-28 w-auto object-contain rounded-md">
                </div>
            @endif

        </div>

        <!-- Inline Add Form (Wired to Laravel!) -->
        <!-- Inline Add Form (Wired to Laravel!) -->
        <!-- Added "no-print" to this line! -->
        <form action="/logs" method="POST" class="no-print mb-12 rounded-2xl border border-border bg-card p-2 shadow-sm">
            @csrf
            <!-- Notice the grid now has 6 sizing parameters! -->
            <div class="grid grid-cols-1 gap-px overflow-hidden rounded-xl bg-border md:grid-cols-[1.2fr_1.5fr_1.5fr_1fr_1fr_auto]">
                <label class="flex flex-col bg-card">
                    <span class="px-4 pt-2 text-[10px] font-medium uppercase tracking-wider text-muted-foreground">Task</span>
                    <input type="text" name="task_name" required placeholder="What needs doing?" class="w-full bg-card px-4 py-3 text-sm text-foreground focus:outline-none">
                </label>
                
                <label class="flex flex-col bg-card">
                    <span class="px-4 pt-2 text-[10px] font-medium uppercase tracking-wider text-muted-foreground">Details</span>
                    <input type="text" name="details" required placeholder="A short note..." class="w-full bg-card px-4 py-3 text-sm text-foreground focus:outline-none">
                </label>

                <!-- Correctly styled Remarks Box! -->
                <label class="flex flex-col bg-card">
                    <span class="px-4 pt-2 text-[10px] font-medium uppercase tracking-wider text-muted-foreground">Remarks</span>
                    <input type="text" name="supervisor_remarks" placeholder="Optional notes..." class="w-full bg-card px-4 py-3 text-sm text-foreground focus:outline-none">
                </label>

                <label class="flex flex-col bg-card">
                    <span class="px-4 pt-2 text-[10px] font-medium uppercase tracking-wider text-muted-foreground">Date</span>
                    <input type="date" name="log_date" required class="w-full bg-card px-4 py-3 text-sm text-foreground focus:outline-none">
                </label>
                
                <label class="flex flex-col bg-card">
                    <span class="px-4 pt-2 text-[10px] font-medium uppercase tracking-wider text-muted-foreground">Status</span>
                    <select name="status" class="w-full appearance-none bg-card px-4 py-3 text-sm text-foreground focus:outline-none">
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
                        <option value="stuck">Stuck</option>
                    </select>
                </label>
                
                <div class="bg-card p-2">
                    <button type="submit" class="h-full w-full rounded-lg bg-primary px-6 py-2 text-sm font-medium text-primary-foreground transition hover:opacity-90 whitespace-nowrap">
                        Add to log →
                    </button>
                </div>
            </div>
        </form>

        <!-- Columns Container -->
        <!-- ========================================== -->
        <!-- VIEW 1: THE KANBAN BOARD                   -->
        <!-- ========================================== -->
        <div id="kanban-view" style="display: block;">
            <!-- Columns Container -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                
                <!-- COLUMN 1: ONGOING -->
                <section class="flex flex-col">
                    <header class="mb-4 flex items-baseline justify-between px-1">
                        <div class="flex items-center gap-2.5">
                            <span class="h-2 w-2 rounded-full bg-ongoing-foreground"></span>
                            <h2 class="text-lg font-medium text-foreground">Ongoing</h2>
                        </div>
                    </header>
<div id="col-ongoing" ondragover="allowDrop(event)" ondragenter="dragEnter(event, 'col-ongoing')" ondragleave="dragLeave(event, 'col-ongoing')" ondrop="drop(event, 'ongoing', 'col-ongoing')" class="drop-zone transition-all duration-200 flex flex-1 flex-col gap-4 rounded-2xl border border-dashed border-border bg-gray-100/50 p-3 min-h-[300px]">                        
    @foreach($logs->where('status', 'ongoing') as $log)
                        <article draggable="true" ondragstart="drag(event, {{ $log->id }})" class="relative overflow-hidden rounded-xl border border-border bg-card shadow-sm p-4 pl-5 cursor-grab active:cursor-grabbing">
                            <span class="absolute inset-y-0 left-0 w-1 bg-ongoing-foreground/70"></span>
                            <h3 class="text-base font-semibold leading-snug text-foreground">{{ $log->task_name }}</h3>
                            <p class="font-mono text-[11px] uppercase tracking-wider text-muted-foreground mt-1">{{ \Carbon\Carbon::parse($log->log_date)->format('d/m/Y') }}</p>
                            <p class="mt-2.5 text-sm leading-relaxed text-foreground/75">{{ $log->details }}</p>
                            <div class="mt-4 flex items-center justify-between border-t border-border/70 pt-3">
                                <span class="rounded-full px-2 py-0.5 text-[10px] font-medium uppercase tracking-wider bg-ongoing text-ongoing-foreground">Ongoing</span>
                                <div class="flex gap-3 text-xs">
                                    <a href="/logs/{{ $log->id }}/edit" class="text-blue-500 hover:underline">Edit</a>
                                    <form action="/logs/{{ $log->id }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </section>

                <!-- COLUMN 2: COMPLETED -->
                <section class="flex flex-col">
                    <header class="mb-4 flex items-baseline justify-between px-1">
                        <div class="flex items-center gap-2.5">
                            <span class="h-2 w-2 rounded-full bg-completed-foreground"></span>
                            <h2 class="text-lg font-medium text-foreground">Completed</h2>
                        </div>
                    </header>
<div id="col-completed" ondragover="allowDrop(event)" ondragenter="dragEnter(event, 'col-completed')" ondragleave="dragLeave(event, 'col-completed')" ondrop="drop(event, 'completed', 'col-completed')" class="drop-zone transition-all duration-200 flex flex-1 flex-col gap-4 rounded-2xl border border-dashed border-border bg-gray-100/50 p-3 min-h-[300px]">                        
    @foreach($logs->where('status', 'completed') as $log)
                        <article draggable="true" ondragstart="drag(event, {{ $log->id }})" class="relative overflow-hidden rounded-xl border border-border bg-card shadow-sm p-4 pl-5 cursor-grab active:cursor-grabbing">
                            <span class="absolute inset-y-0 left-0 w-1 bg-completed-foreground/70"></span>
                            <h3 class="text-base font-semibold leading-snug text-foreground">{{ $log->task_name }}</h3>
                            <p class="font-mono text-[11px] uppercase tracking-wider text-muted-foreground mt-1">{{ \Carbon\Carbon::parse($log->log_date)->format('d/m/Y') }}</p>
                            <p class="mt-2.5 text-sm leading-relaxed text-foreground/75">{{ $log->details }}</p>
                            <div class="mt-4 flex items-center justify-between border-t border-border/70 pt-3">
                                <span class="rounded-full px-2 py-0.5 text-[10px] font-medium uppercase tracking-wider bg-completed text-completed-foreground">Completed</span>
                                <div class="flex gap-3 text-xs">
                                    <a href="/logs/{{ $log->id }}/edit" class="text-blue-500 hover:underline">Edit</a>
                                    <form action="/logs/{{ $log->id }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </section>

                <!-- COLUMN 3: STUCK -->
                <section class="flex flex-col">
                    <header class="mb-4 flex items-baseline justify-between px-1">
                        <div class="flex items-center gap-2.5">
                            <span class="h-2 w-2 rounded-full bg-stuck-foreground"></span>
                            <h2 class="text-lg font-medium text-foreground">Stuck</h2>
                        </div>
                    </header>
<div id="col-stuck" ondragover="allowDrop(event)" ondragenter="dragEnter(event, 'col-stuck')" ondragleave="dragLeave(event, 'col-stuck')" ondrop="drop(event, 'stuck', 'col-stuck')" class="drop-zone transition-all duration-200 flex flex-1 flex-col gap-4 rounded-2xl border border-dashed border-border bg-gray-100/50 p-3 min-h-[300px]">                        
    @foreach($logs->where('status', 'stuck') as $log)
                        <article draggable="true" ondragstart="drag(event, {{ $log->id }})" class="relative overflow-hidden rounded-xl border border-border bg-card shadow-sm p-4 pl-5 cursor-grab active:cursor-grabbing">
                            <span class="absolute inset-y-0 left-0 w-1 bg-stuck-foreground/70"></span>
                            <h3 class="text-base font-semibold leading-snug text-foreground">{{ $log->task_name }}</h3>
                            <p class="font-mono text-[11px] uppercase tracking-wider text-muted-foreground mt-1">{{ \Carbon\Carbon::parse($log->log_date)->format('d/m/Y') }}</p>
                            <p class="mt-2.5 text-sm leading-relaxed text-foreground/75">{{ $log->details }}</p>
                            <div class="mt-4 flex items-center justify-between border-t border-border/70 pt-3">
                                <span class="rounded-full px-2 py-0.5 text-[10px] font-medium uppercase tracking-wider bg-stuck text-stuck-foreground">Stuck</span>
                                <div class="flex gap-3 text-xs">
                                    <a href="/logs/{{ $log->id }}/edit" class="text-blue-500 hover:underline">Edit</a>
                                    <form action="/logs/{{ $log->id }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </section>

            </div>
        </div>

        <!-- ========================================== -->
        <!-- VIEW 2: THE OFFICIAL UNIVERSITY TABLE      -->
        <!-- ========================================== -->
        <div id="table-view" style="display: none;" class="bg-white p-10 shadow-sm border border-gray-200 mt-8 rounded-xl">
            
            <h2 style="text-align: center; font-family: serif; font-size: 24px; font-weight: bold;">INTERNSHIP DAILY LOGBOOK</h2>
            <p style="text-align: center; font-family: serif; margin-bottom: 30px;">{{ Auth::user()->company_name ? strtoupper(Auth::user()->company_name) : 'MY COMPANY' }}</p>

           <table style="width: 100%; border-collapse: collapse; font-family: serif; border: 1px solid black;">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; padding: 12px; text-align: left;">Date</th>
                        <th style="border: 1px solid black; padding: 12px; text-align: left;">Task Details</th>
                        
                        <!-- The status will still hide on print! -->
                        <th class="no-print" style="border: 1px solid black; padding: 12px; text-align: left;">Status</th> 
                        
                        <th style="border: 1px solid black; padding: 12px; text-align: left;">Supervisor Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td style="border: 1px solid black; padding: 12px; vertical-align: top;">
                            {{ \Carbon\Carbon::parse($log->log_date)->format('d/m/Y') }}
                        </td>
                        
                        <td style="border: 1px solid black; padding: 12px; vertical-align: top;">
                            <strong>{{ $log->task_name }}</strong><br>
                            {{ $log->details }}
                        </td>
                        
                        <td class="no-print" style="border: 1px solid black; padding: 12px; vertical-align: top;">
                            <span class="badge {{ $log->status }}">{{ ucfirst($log->status) }}</span>
                        </td>

                        <td style="border: 1px solid black; padding: 12px; vertical-align: top;">
                            {{ $log->supervisor_remarks }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
</body>
</html>

<script>
    // 1. When you pick up a card
    function drag(ev, id) {
        ev.dataTransfer.setData("taskId", id);
        
        // Add a tiny delay so the ghost image stays normal, but the original card fades
        setTimeout(() => {
            ev.target.classList.add('opacity-40', 'scale-95', 'rotate-1');
        }, 10);
    }

    // 2. When you let go of the card (fixes the card staying transparent)
    document.addEventListener('dragend', function(ev) {
        if(ev.target.classList) {
            ev.target.classList.remove('opacity-40', 'scale-95', 'rotate-1');
        }
        // Remove highlights from all columns
        document.querySelectorAll('.drop-zone').forEach(el => {
            el.classList.remove('bg-gray-200/50', 'border-primary', 'shadow-inner');
        });
    });

    // 3. Allow dropping
    function allowDrop(ev) {
        ev.preventDefault();
    }

    // 4. Highlight the column when hovering over it!
    function dragEnter(ev, columnId) {
        ev.preventDefault();
        const col = document.getElementById(columnId);
        if(col) col.classList.add('bg-gray-200/50', 'border-primary', 'shadow-inner');
    }

    // 5. Remove highlight when leaving the column
    function dragLeave(ev, columnId) {
        const col = document.getElementById(columnId);
        if(col) col.classList.remove('bg-gray-200/50', 'border-primary', 'shadow-inner');
    }

    // 6. The Magic Drop!
    function drop(ev, newStatus, columnId) {
        ev.preventDefault();
        
        // Remove highlight instantly
        const col = document.getElementById(columnId);
        if(col) col.classList.remove('bg-gray-200/50', 'border-primary', 'shadow-inner');

        var id = ev.dataTransfer.getData("taskId");

        // Send the invisible AJAX request
        fetch(`/logs/${id}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' 
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(response => {
            if(response.ok) {
                window.location.reload(); 
            } else {
                alert("Something went wrong saving the status.");
            }
        });
    }

    // Toggle Views
    function switchView(viewName) {
        if (viewName === 'kanban') {
            document.getElementById('kanban-view').style.display = 'block';
            document.getElementById('table-view').style.display = 'none';
        } else if (viewName === 'table') {
            document.getElementById('kanban-view').style.display = 'none';
            document.getElementById('table-view').style.display = 'block';
        }
    }
</script>



