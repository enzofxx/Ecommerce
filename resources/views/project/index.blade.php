

    <section style="display: flex; align-items: center; flex-direction: column;">
        <h1>Project name: {{ $project->project_name }}</h1>
        <h3>Number of groups:  {{ $project->group_count }}</h3>
        <h3>Students per group: {{ $project->student_count }}</h3>
    </section>
    <section style="margin: 0 auto; width: 30%">
        <h2 style="text-align: center;">Students</h2>
        <section>
            <div style="display: inline-block; width: 30%; background-color: #bfbfbd; padding: 5px 0;">Student</div>
            <div style="display: inline-block; width: 30%; background-color: #bfbfbd; padding: 5px 0;">Group</div>
            <div style="display: inline-block; width: 30%; background-color: #bfbfbd; padding: 5px 0;">Actions</div>
        </section>
        <section style="padding-bottom: 30px;">
            @foreach($students as $student)
                <div style="padding-top: 15px;">
                    <div style="display: inline-block; width: 30%;">{{ $student->student_name}}</div>
                    <div style="display: inline-block; width: 30%;">
                        @if(!empty($student->groups[0]))
                            {{ $student->groups[0]->group_name }}
                        @endif
                    </div>
                    <div style="display: inline-block; width: 30%;">
                        <form style="margin: 0 auto;" method="POST" action="{{ route('students.destroy', $student) }}">
                            @method('DELETE')
                            @csrf
                            <input style="padding: 10px 20px; background-color: red; border: none; border-radius: 5px;" type="submit" name="delete" value="Delete">
                        </form>
                    </div>
                </div>
            @endforeach
        </section>
        <a style="padding: 10px 20px; background-color: lightgreen; text-decoration: none; border-radius: 5px; color: black; cursor: pointer;" href="{{ route('students.create') }}">Add new student</a>
    </section>

    <section >
        <h2 style="text-align: center;">Groups</h2>
        <section style="display: flex; justify-content: center; gap: 5px;">
        @for($i = 0; $i < $project->group_count; $i++)
            <article style="display: inline-block; width: 170px; border: 1px solid grey;">
            <p style="background-color: #dbdbdb; padding: 10px 0; text-align: center; font-weight: 600; margin-top: 0;">{{ $groups[$i*$project->student_count]['group_name'] }}</p>
                @for($j = 0; $j < $project->student_count; $j++)
                    @if($groups[$i*$project->student_count+$j]->student_id !== 0)
                        <div >
                            <div style="height: 30px; margin: 5px;">{{ $groups[$i*$project->student_count+$j]->student_name }}</div>
                        </div>
                    @else
                        <div >
                            <select style="height: 30px; margin: 5px;" onchange="addGroup(this.options[this.selectedIndex].value, {{ $i*$project->student_count+$j+1 }})">
                                <option style="background-color: #dbdbdb; padding: 5px;">Select Student</option>
                                @foreach($studentsWithoutGroup as $student)
                                    <option style="background-color: #dbdbdb; padding: 5px;" value="{{ $student->id }}">{{ $student->student_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                @endfor
            </article>
        @endfor
        </section>
    </section>

    <script type="text/javascript">
        function autoRefreshPage()
        {
            window.location = window.location.href;
        }
        setInterval('autoRefreshPage()', 10000);
    </script>
<script>
    function addGroup(studentId, groupId){
        let url = "{{ route('addGroup', [':studentId', ':groupId']) }}";
        url = url. replace(':studentId', studentId);
        url = url. replace(':groupId', groupId);
        document. location. href=url;
    }
</script>
