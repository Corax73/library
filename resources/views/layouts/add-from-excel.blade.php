@extends('admin-forms')

@section('form')
<div class="container">
                                        <form enctype="multipart/form-data" action="{{ route('parse') }}" method="post" style="border: 4px double black">
                                            @csrf
                                            <div class="input-group">
                                                <label for="table">Add .xlsx file</label>
                                                <input type="file" class="form-control-file" id="table" name="table" accept="xlsx/*" required>
                                                @if ($errors->has('table'))
                                                <span class="text-danger">{{ $errors->first('table') }}</span>
                                                @endif
                                                @if ($status)
                                                <span class="text-danger">{{ $status }}</span>
                                                @endif
                                            </div>
                                            <p><input type="submit" name="action" class="b1" value="Save"></p>
                                            </form>
                                    </div>
@endsection