<div class="form-check">
    <input disabled type="radio" value="Sobresaliente" id="rb1-{{$evaluation->id}}-{{$question->id}}" name="customRadioInline-{{$question->id}}" class="form-check-input" {{ ( (\DB::table('answers')->where('id_question', $question->id)->get()->pluck('selected_answer')->first())=="rb1-$evaluation->id-$question->id")? "checked" : "" }}>
    <label class="form-check-label" for="rb1-{{$evaluation->id}}-{{$question->id}}">{{ $option->first_option }}</label>
</div>
<div class="form-check" id="check">
    <input disabled type="radio" value="Satisfactorio" id="rb2-{{$evaluation->id}}-{{$question->id}}" name="customRadioInline-{{$question->id}}" class="form-check-input" {{ ( (\DB::table('answers')->where('id_question', $question->id)->get()->pluck('selected_answer')->first())=="rb2-$evaluation->id-$question->id")? "checked" : "" }}>
    <label class="form-check-label" for="rb2-{{$evaluation->id}}-{{$question->id}}">{{ $option->second_option }}</label>
</div>
<div class="form-check">
    <input disabled type="radio" value="Medianamente satisfactorio" id="rb3-{{$evaluation->id}}-{{$question->id}}" name="customRadioInline-{{$question->id}}" class="form-check-input" {{ ( \DB::table('answers')->where('id_question', $question->id)->get()->pluck('selected_answer')->first()=="rb3-$evaluation->id-$question->id")? "checked" : "" }}>
    <label class="form-check-label" for="rb3-{{$evaluation->id}}-{{$question->id}}">{{ $option->third_option }}</label>
</div>
<div class="form-check">
    <input disabled type="radio" value="Regularmente satisfactorio" id="rb4-{{$evaluation->id}}-{{$question->id}}" name="customRadioInline-{{$question->id}}" class="form-check-input" {{ ( \DB::table('answers')->where('id_question', $question->id)->get()->pluck('selected_answer')->first()=="rb4-$evaluation->id-$question->id")? "checked" : "" }}>
    <label class="form-check-label" for="rb4-{{$evaluation->id}}-{{$question->id}}">{{ $option->fourth_option }}</label>
</div>
<div class="form-check">
    <input disabled type="radio" value="No satisfactorio" id="rb5-{{$evaluation->id}}-{{$question->id}}" name="customRadioInline-{{$question->id}}" class="form-check-input" {{ ( \DB::table('answers')->where('id_question', $question->id)->get()->pluck('selected_answer')->first()=="rb5-$evaluation->id-$question->id")? "checked" : "" }}>
    <label class="form-check-label" for="rb5-{{$evaluation->id}}-{{$question->id}}">{{ $option->fifth_option }}</label>
</div>
<div class="form-check">
    <input disabled type="radio" value="No aplica" id="rb6-{{$evaluation->id}}-{{$question->id}}" name="customRadioInline-{{$question->id}}" class="form-check-input" {{ ( \DB::table('answers')->where('id_question', $question->id)->get()->pluck('selected_answer')->first()=="rb6-$evaluation->id-$question->id")? "checked" : "" }}>
    <label class="form-check-label" for="rb6-{{$evaluation->id}}-{{$question->id}}">{{ $option->default_option }}</label>
</div>