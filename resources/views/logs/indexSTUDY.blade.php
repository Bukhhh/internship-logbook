 
 //I LEARNED THE BASIC HERE TO CREATE A FORM
 
 
 <h1> Hyprepresso Insights - Daily Log </h1>
    <form action="/logs" method="POST">
        @csrf

        <div>
            <label> Task Name: </label>
            <input type="text" name="task_name">
        </div>

         <div>

            <label> Details: </label>
            <textarea name="details"> </textarea>
        </div>

         <div>

            <label> Date: </label>
            <input type="date" name="log_date">
        </div>
         

        <div>
            <label> Status: </label>
            <select name="status">
                <option value="ongoing"> Ongoing </option>
                <option value="completed"> Completed </option>
                <option value="stuck"> Stuck </option>

             </select>
        </div>

        <button type="submit"> Submit </button>
    </form>

    <hr style="margin: 40px 0;">
    <h2>My Logbook History</h2>

    <ul>
        <!-- This loop goes through every single log in the database -->
        @foreach($logs as $log)
            <li style="margin-bottom: 20px; padding: 15px; border: 1px solid #ccc;">
                <strong>Task:</strong> {{ $log->task_name }} <br>
                <strong>Date:</strong> {{ $log->log_date }} <br>
                <strong>Status:</strong> {{ $log->status }} <br>
                <strong>Details:</strong> {{ $log->details }}
            
        <a href="/logs/{{ $log->id }}/edit" style="color: blue; margin-right: 10px; text-decoration: none;">Edit</a>
        
        <!-- THE NEW DELETE BUTTON -->
                <form action="/logs/{{ $log->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE') <!-- This is the secret Laravel trick! -->
                    <button type="submit" style="color: red;">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>