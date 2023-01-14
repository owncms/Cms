<div class="tab-pane" id="media" role="tabpanel"
     aria-labelledby="pills-media-tab">
    <div class="row">
        <div class="col-md-6 col-12">
            @php $image = $item->getMedia('image')->first() @endphp
            <div class="file-wrapper d-flex" @if($image) style="visibility: hidden" @endif>
                <input type="file" name="files[image]" @if($image) disabled @endif style="display: none">
                <div class="file--left text-left upload--file-btn">
                    <span>Upload</span>
                </div>
                <div class="file--preview">
                    <span>No file</span>
                </div>
            </div>
            @if($image)
                <div class="file-wrapper d-flex">
                    <input type="file" name="curr_files[image]" style="display: none">
                    <div class="file--left text-left upload--file-btn">
                        <span>Upload</span>
                    </div>
                    <div class="file--preview">
                        <img src="{{$image->getUrl()}}">
                        <div class="file--remove" data-file_id="{{ $image->id }}">
                            <span class="fa fa-trash"></span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                @foreach($item->getMedia('images') as $media)
                    <div class="file-wrapper d-flex">
                        <input type="hidden" name="curr_files[images][]" value="{{ $media->id }}">
                        <div class="file--left text-left upload--file-btn">
                            <span>Upload</span>
                        </div>
                        <div class="file--preview">
                            <img src="{{$media->getUrl()}}">
                            <div class="file--remove" data-file_id="{{ $media->id }}">
                                <span class="fa fa-trash"></span>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="file-wrapper d-flex">
                    <input type="file" name="files[images]" style="display: none">
                    <div class="file--left text-left upload--file-btn">
                        <span>Upload</span>
                    </div>
                    <div class="file--preview">
                        <span>No file</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
