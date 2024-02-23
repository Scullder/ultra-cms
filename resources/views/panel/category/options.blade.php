@foreach ($categories as $category)
    <option value="{{ $category->id }}" @selected($category->selected)>{{ $category->name }}</option>
@endforeach