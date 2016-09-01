@extends('layouts.main')
@section('content')

 <div class="col-md-8 col-lg-offset-2">
     <h2 class="text-center text-primary">Observation Form Pact Submission</h2>
     <h5 class="text-center text-muted">Fill the form and submit it</h5>
     <br/>

     @if (count($errors) > 0)
       <div class="alert alert-danger">
         <strong>Whoops!</strong> There were some problems with your input.<br><br>
         <ul>
           @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
           @endforeach
         </ul>
       </div>
     @endif

     <form role="form" method="POST" action="{{ url('/submissions/store/new') }}">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <fieldset>

                      <legend>Where did you see it?</legend>
                      <div class="col-lg-6">
                        <label>Department</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-building"></i>
                          </div>
                          <select type="text" class="form-control" name="department_id">
                            @foreach ($departments as $dept)
                              <option value="{{$dept->id}}">{{$dept->name}}</option>
                            @endforeach
                          </select>
                        </div>
</div>
  <div class="col-lg-6">
    <label>Section/Team</label>
                        <div class="input-group ">
                          <div class="input-group-addon">
                            <i class="fa fa-users"></i>
                          </div>
                          <select type="text" class="form-control" name="section_id">
                            @foreach ($teams as $team)
                              <option value="{{$team->id}}">{{$team->name}}</option>
                            @endforeach
                          </select>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <h4>.</h4>
                        </div>
                    </fieldset>

                    <fieldset>
                      <legend>When did you see it?</legend>
                  <div class="col-lg-4">
                  <label>Date:</label>
                  <div class="input-group col-lg-12">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" type="date" name="date">
                  </div><!-- /.input group -->
                </div>

                <div class="col-lg-4">
                    <label>Start Time</label>
                        <div class="input-group col-lg-12">

                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                          <input type="time" class="form-control timepicker" name="start_time" value="{{ old('start_time') }}">
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <label>Duration (Minutes)</label>
                        <div class="input-group col-lg-12">
                          <div class="input-group-addon">
                            <i class="fa fa-moon-o"></i>
                          </div>
                          <input type="number" min="1" max="1000"  class="form-control" name="end_time"  value="{{ old('end_time') }}">
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <h4>.</h4>
                      </div>
                      <legend>What did you see</legend>
                        <div class="form-group col-lg-12">
                          <label>Observation</label>
                          <textarea  name="observation" rows=6  class="form-control" placeholder="Explain what you saw" >{{ old('observation') }}</textarea>
                        </div>

                      <legend>What's your comment about the observation</legend>
                        <div class="form-group col-lg-12">
                          <label>Comment</label>
                          <textarea name="comment"  rows=6 class="form-control" placeholder="Comment what you saw">{{ old('comment') }}</textarea>
                        </div>

                      <legend>Task being carried out?</legend>
                        <div class="form-group col-lg-12">
                          <label>Task</label>
                          <textarea  name="task" rows=6 class="form-control" placeholder="What task was being carried out">{{ old('task') }}</textarea>
                        </div>

                        <legend>VALUES (Select values under observation –Refer to pact)</legend>
                        <div class="col-md-12">

                            <?php
                            $value_id = 0;
                            foreach ($values as $value):
                              $value_id+=1;
                              ?>

                              <div class="form-group col-lg-6">
                                  <label>
                                    <input type="checkbox" name="values_{{$value_id}}" value="{{$value}}">
                                    {{$value}}
                                  </label>
                              </div>

                          <?php endforeach ?>
                        </br>

                        </div>


                        <legend>Behaviour Classification</legend>


                        <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                  <th>Observable Behaviours/Observer & observed engagement</th>
                                  <th>Safe/Unsafe</th>

                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($behaviours as $b)
                                <tr>
                                  <td>{{$b->description}}</td>
                                  <td>
                                    <select class="form-control" name="behaviour_{{$b->id}}">
                                      <option value=""></option>
                                      <option value="safe">Safe</option>
                                      <option value="unsafe">Unsafe</option>
                                    </select>
                                </td>
                                </tr>
                                @endforeach

                              </tbody>
                            </table>
                        </div>

                    </fieldset>


                    <input type="submit" name="submit" class="btn btn-lg btn-block btn-primary" value="Submit">
                  </form>
                <br/><br/><br/><br/>
</div>

@endsection

<script type="text/javascript">
  (function(){
    //Datemask2 mm/dd/yyyy
    $(".timepicker").timepicker({
          showInputs: false
        });
        $("#sub_date").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
  })
</script>
