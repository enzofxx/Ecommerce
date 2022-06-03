



<form style="display: flex; flex-direction: column; align-items: center; gap: 15px;" action="{{ route('projects.store') }}" method="post">
    @csrf
    <label for="name">Project name</label>
    <input id="name" type="text" name="project_name">
    <label for="group">How many groups in the project</label>
    <input id="group" type="number" name="group_count">
    <label for="student">How many students per group</label>
    <input id="student" type="number" name="student_count">
    <input type="submit" name="sumbit" value="Create project">
</form>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p style="background-color: red; padding: 15px 0; text-align: center;">{{ $error }}</p>
        @endforeach
    </div>
@endif
