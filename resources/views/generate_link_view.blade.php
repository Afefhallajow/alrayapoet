@extends('layouts.appp')
@push('css')
<style>
#ad{
        white-space: pre-wrap;
    }
   h4{
      color: white;
   }
   h2{
      color: white;
   }
</style>
@endpush
@section('content')

    <div class="row ">
       <div class="col-sm-12 col-lg-12">
              <form action="{{ url()->current() }}" method="post">
                  @csrf
                  <label>
                      الملاحطة
                  </label>
                  <textarea id="ad" name="note" class="form-control"> </textarea><br>
                  <button class="btn btn-primary" type="submit">
                      إرسال
                  </button>
              </form>
       </div>

    </div>
@endsection

@push('script')

@endpush
