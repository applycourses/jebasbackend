   <table class="table table-bordered">
    <thead>
        <tr>
            <th width="8%">Sl. No.</th>
            <th>Question <small>(Click on the question to see answer)</small></th>
            <th width="2%">Copy</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key => $value)
        <tr>
            <td>{{ ++$key }}</td>
            <td>
                <div class="question" data-toggle="collapse" data-target="#answer1">
                   {{ $value->question }}
                </div>
                <div id="answer1" class="collapse answer"> {{ $value->answer }} </div> </td> <td>
                <button class="btn btn-xs blue copy"><i class="fa fa-clone"></i></button>
            </td>
        </tr>
      
        @endforeach
    </tbody>
</table>