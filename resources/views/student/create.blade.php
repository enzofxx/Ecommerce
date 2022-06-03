
<form style="display: flex; flex-direction: column; align-items: center; gap: 15px;" action="{{ route('students.store') }}" method="post">
    @csrf
    <label for="name">Student name</label>
    <input id="name" type="text" name="student_name">
    <input type="submit" name="submit" value="Add student">
</form>
<a style="display: flex; flex-direction: column; align-items: center; gap: 15px;" href=" {{ route('projects.index') }}">Back</a>
@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p style="background-color: red; padding: 15px 0; text-align: center;">{{ $error }}</p>
        @endforeach
    </div>
@endif
