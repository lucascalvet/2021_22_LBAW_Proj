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
  <a class="btn btn-secondary" href="{{ $link_create_text }}">
      <i class="bi bi-pencil-square {{ $icon_size }}"></i>
  </a>
  <a class="btn btn-secondary" href="{{ $link_create_media }}">
      <i class="bi bi-file-earmark-richtext {{ $icon_size }}"></i>
  </a>
</div>
