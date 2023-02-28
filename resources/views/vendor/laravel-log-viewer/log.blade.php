@extends('admin.layouts.app' , ['title' => 'سیستم ثبت وقایع'])
@section('head-tag')
  <style>
    .active-log {
      background: #2563eb;
      color: #eff6ff;
    }
  </style>
@endsection
@section('content')
<div class="row justify-content-center">
  <div class="col">
      <h2 class="h3 mb-0 page-title">
        سیستم ثبت وقایع
      </h2>
  </div>
</div>
<div class="row" style="margin-top:2rem">
  <div class="col-md-3 mb-3">
    <div class="list-group div-scroll pl-0">
          @foreach($folders as $folder)
            <div class="list-group-item w-100">
              <?php
              \Rap2hpoutre\LaravelLogViewer\LaravelLogViewer::DirectoryTreeStructure( $storage_path, $structure );
              ?>

            </div>
          @endforeach
          @foreach($files as $file)
            <a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}"
              class="list-group-item @if ($current_file == $file) active-log text-white @endif">
              @php  
                $fileName = str_replace('laravel-' , '' , $file);
                $fileName = str_replace('.log' , '' , $fileName);
              @endphp
              {{ validateDate($fileName) ? jalaliDate($fileName , '%d %B %Y') : $fileName }}
            </a>
          @endforeach
    </div>
  </div>
  <div class="col-md-9 table-container px-0">
        @if ($logs === null)
          <div>
            حجم لاگ ها بیش از حد مجاز است لطفا دانلود کنید
          </div>
        @else
          <table id="table-log" class="table table-striped" data-ordering-index="{{ $standardFormat ? 2 : 0 }}">
            <thead>
            <tr>
              @if ($standardFormat)
                <th>اولویت</th>
                <th>زمان</th>
              @else
                <th>#</th>
              @endif
              <th>جزئیات</th>
            </tr>
            </thead>
            <tbody>

            @foreach($logs as $key => $log)
              <tr data-display="stack{{{$key}}}">
                @if ($standardFormat)
                  <td class="nowrap text-{{{$log['level_class']}}}">
                    <span class="fa fa-{{{$log['level_img']}}}" aria-hidden="true"></span>&nbsp;&nbsp;{{$log['level']}}
                  </td>
                @endif
                <td class="date">{{{ jalaliDate($log['date'] , "H:i") }}}</td>
                <td class="text">
                  @if ($log['stack'])
                    <button type="button"
                            class="float-right expand btn btn-outline-dark btn-sm mb-2 ml-2"
                            data-display="stack{{{$key}}}">
                      <span class="fa fa-search"></span>
                    </button>
                  @endif
                  <div style="white-space: pre-wrap;">
                    {{{ Str::limit($log['text'])}}}
                  </div>
                  @if (isset($log['in_file']))
                    <br/>{{{$log['in_file']}}}
                  @endif
                  @if ($log['stack'])
                    <div class="stack" id="stack{{{$key}}}"
                        style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}
                    </div>
                  @endif
                </td>
              </tr>
            @endforeach

            </tbody>
          </table>
        @endif
        <div class="p-3 d-flex justify-content-between flex-wrap">
          @if($current_file)
            <a href="?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
              <span class="fa fa-download"></span> دانلود فایل
            </a>
            -
            <a id="clean-log" href="?clean={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
              <span class="fa fa-sync"></span> پاک کردن محتوای فایل
            </a>
            -
            <a id="delete-log" href="?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
              <span class="fa fa-trash"></span> حذف فایل
            </a>
            @if(count($files) > 1)
              -
              <a id="delete-all-log" href="?delall=true{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                <span class="fa fa-trash-alt"></span> حذف همه ی فایل ها
              </a>
            @endif
          @endif
        </div>
  </div>
</div>
@endsection

@section('script')
<!-- FontAwesome -->
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<!-- Datatables -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
  // end darkmode js
        
  $(document).ready(function () {
    $('.table-container tr').on('click', function () {
      $('#' + $(this).data('display')).toggle();
    });
    $('#table-log').DataTable({
      "order": [$('#table-log').data('orderingIndex'), 'desc'],
      "stateSave": true,
      "stateSaveCallback": function (settings, data) {
        window.localStorage.setItem("datatable", JSON.stringify(data));
      },
      "stateLoadCallback": function (settings) {
        var data = JSON.parse(window.localStorage.getItem("datatable"));
        if (data) data.start = 0;
        return data;
      }
    });
    $('#delete-log, #clean-log, #delete-all-log').click(function () {
      return confirm('Are you sure?');
    });
  });
</script>
@endsection
