@php
if (isset($id_group)) {
    $link_create_text = route('textcontent.make', ['id_group' => $id_group]);
    $link_create_media = route('mediacontent.make', ['id_group' => $id_group]);
} else {
    $link_create_text = route('textcontent.make');
    $link_create_media = route('mediacontent.make');
}
@endphp

<div class="d-none d-lg-flex justify-content-around py-3">
  <a href="{{ $link_create_text }}">
    <button type="button" class="btn btn-secondary" style="width: auto; height: auto;" data-bs-toggle="tooltip" data-bs-placement="top" title="Create a text content">
      <i class="bi bi-pencil-square {{ $icon_size }}"></i>
    </button>
  </a>
  <a href="{{ $link_create_media }}">
    <button type="button" class="btn btn-secondary" style="width: auto; height: auto;" data-bs-toggle="tooltip" data-bs-placement="top" title="Create a media content">
      <i class="bi bi-file-earmark-richtext {{ $icon_size }}"></i>
    </button>
  </a>
</div>
