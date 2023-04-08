@extends('app.layouts.app', ['title' => 'ارتباط با شهروندان - ثبت شکایات ، انتقاد و پیشنهاد'])

@section('head-tag')
    <script src="{{ asset('assets/admin/plugins/tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
@endsection

@section('content')
    <form action="{{ route('communications.store') }}" method="post">
        @csrf
        <section class="min-h-screen">
            <section class="md:w-8/12 bg-white shadow-sm p-3 my-3 md:my-8 mx-1.5 sm:mx-3 md:mx-auto rounded-3xl">
                <section class="text-center my-4">
                    <h1 class="text-2xl text-gray-700 font-bold my-2">با ما در ارتباط باشید</h1>
                    <div class="text-xs my-3 sm:text-sm text-gray-600">شما می توانید انتقادات پیشنهادات ، شکایات و درخواست
                        هایتان را ثبت بفرمایید</div>
                </section>
                @if ($message = session('toast-success'))
                    <div class="flex p-4 mb-4 text-sm rounded-lg bg-low-dark text-green-400 border border-green-400"
                        role="alert">
                        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 ml-3" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">{{ $message }}</span>
                        </div>
                    </div>
                @endif
                <section class="grid grid-cols-12 gap-2.5 mt-10 space-y-3 space-y-reverse">
                    <section class="col-span-full md:col-span-6">
                        <label for="fullname" class="custom-label">نام و نام خانوادگی</label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" id="fullname"
                            class="custom-input @error('full_name') error-input @enderror">
                        @error('full_name')
                            <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
                        @enderror
                    </section>
                    <section class="col-span-full md:col-span-6">
                        <label for="type" class="custom-label">نوع درخواست</label>
                        <select name="type" id="type" class="custom-input @error('type') error-input @enderror">
                            @foreach ($types as $key => $type)
                                <option value="{{ $key }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
                        @enderror
                    </section>
                    <section class="col-span-full md:col-span-6">
                        <label for="subject" class="custom-label">موضوع درخواست</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" id="subject"
                            class="custom-input @error('subject') error-input @enderror">
                        @error('subject')
                            <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
                        @enderror
                    </section>
                    <section class="col-span-full md:col-span-6">
                        <label for="phone" class="custom-label">شماره تلفن (اختیاری)</label>
                        <input type="number" name="phone" value="{{ old('phone') }}" id="phone"
                            class="custom-input @error('phone') error-input @enderror">
                        @error('phone')
                            <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
                        @enderror
                    </section>
                    <section class="col-span-full">
                        <label for="editor" class="custom-label">محتوا و توضیحات</label>
                        <textarea name="description" id="editor" cols="30" rows="10">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
                        @enderror
                    </section>
                    <section class="col-span-full">
                        <label for="address" class="custom-label">آدرس محل گزارش (اختیاری)</label>
                        <textarea name="address" id="address" class="custom-input @error('address') error-input @enderror" cols="30"
                            rows="2">{{ old('address') }}</textarea>
                        @error('address')
                            <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
                        @enderror
                    </section>
                </section>
                <section class="flex justify-center py-4">
                    <button type="submit"
                        class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-7 py-3 text-center mb-2">ثبت</button>
                </section>
            </section>
    </form>
@endsection


@section('script')
    <script>
        function renderEditor(key) {
            let editor_config = {
                selector: key,
                relative_urls: false,
                plugins: 'directionality table fullscreen',
                language: 'fa',
                toolbar: [{
                        name: 'styles',
                        items: ['styleselect']
                    },
                    {
                        name: 'formatting',
                        items: ['bold', 'italic', 'underline']
                    },
                    {
                        name: 'alignment',
                        items: ['alignright', 'aligncenter', 'alignleft', 'alignjustify', "format"]
                    },
                    {
                        name: 'indentation',
                        items: ['outdent', 'indent']
                    },
                    {
                        name: 'table',
                        items: ['table']
                    },
                    {
                        name: 'direction',
                        items: ['rtl', 'ltr']
                    },
                    {
                        name: 'history',
                        items: ['undo', 'redo']
                    },
                    {
                        name: 'fullscreen',
                        items: ["fullscreen"]
                    },
                ],
            };

            tinymce.init(editor_config);
        }
    </script>
    <script>
        renderEditor('#editor')
    </script>
@endsection
