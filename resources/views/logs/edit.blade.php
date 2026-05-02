<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task - [Your Company Name]</title>
    
    <!-- We bring in the exact same Tailwind CSS and colors from your main page -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        border: "hsl(214.3 31.8% 91.4%)",
                        background: "hsl(0 0% 100%)",
                        foreground: "hsl(222.2 84% 4.9%)",
                        primary: "hsl(222.2 47.4% 11.2%)",
                        "primary-foreground": "hsl(210 40% 98%)",
                        muted: "hsl(210 40% 96.1%)",
                        "muted-foreground": "hsl(215.4 16.3% 46.9%)",
                        card: "hsl(0 0% 100%)",
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-gray-50 text-foreground font-sans py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Main Centered Container -->
    <div class="max-w-xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8">
            <a href="/logs" class="text-sm text-muted-foreground hover:text-foreground transition inline-flex items-center gap-2 mb-6">
                ← Back to Logbook
            </a>
            <div class="mb-2 inline-flex items-center gap-2 text-xs font-medium uppercase tracking-[0.18em] text-muted-foreground">
                <span class="h-px w-8 bg-foreground/30"></span>
                Task Editor
            </div>
            <h1 class="text-4xl font-medium leading-[1.05] text-foreground">
                Edit <em class="italic text-foreground/70">Entry</em>.
            </h1>
        </div>

        <!-- The Form Card -->
        <div class="bg-card border border-border shadow-sm rounded-2xl p-6 sm:p-8">
            <form action="/logs/{{ $log->id }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT') <!-- The secret Update command! -->

                <!-- Task Name -->
                <div>
                    <label class="block text-xs font-medium uppercase tracking-wider text-muted-foreground mb-2">Task Name</label>
                    <input type="text" name="task_name" value="{{ old('task_name', $log->task_name) }}" class="w-full rounded-xl border border-border bg-gray-50 px-4 py-3 text-sm text-foreground focus:outline-none focus:ring-1 focus:ring-foreground transition">
                    @error('task_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Details -->
                <div>
                    <label class="block text-xs font-medium uppercase tracking-wider text-muted-foreground mb-2">Details</label>
                    <textarea name="details" rows="4" class="w-full rounded-xl border border-border bg-gray-50 px-4 py-3 text-sm text-foreground focus:outline-none focus:ring-1 focus:ring-foreground transition">{{ old('details', $log->details) }}</textarea>
                    @error('details') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Date & Status (Side by Side on desktop) -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Date -->
                    <div>
                        <label class="block text-xs font-medium uppercase tracking-wider text-muted-foreground mb-2">Date</label>
                        <input type="date" name="log_date" value="{{ old('log_date', $log->log_date) }}" class="w-full rounded-xl border border-border bg-gray-50 px-4 py-3 text-sm text-foreground focus:outline-none focus:ring-1 focus:ring-foreground transition">
                        @error('log_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-xs font-medium uppercase tracking-wider text-muted-foreground mb-2">Status</label>
                        <select name="status" class="w-full appearance-none rounded-xl border border-border bg-gray-50 px-4 py-3 text-sm text-foreground focus:outline-none focus:ring-1 focus:ring-foreground transition">
                            <option value="ongoing" {{ old('status', $log->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ old('status', $log->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="stuck" {{ old('status', $log->status) == 'stuck' ? 'selected' : '' }}>Stuck</option>
                        </select>
                        @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="pt-4 flex items-center justify-end gap-4 border-t border-border mt-6">
                    <a href="/logs" class="text-sm font-medium text-muted-foreground hover:text-foreground">Cancel</a>
                    <button type="submit" class="rounded-lg bg-primary px-6 py-2.5 text-sm font-medium text-primary-foreground shadow-sm hover:opacity-90 transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
        
    </div>
</body>
</html>