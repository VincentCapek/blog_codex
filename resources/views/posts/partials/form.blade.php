@csrf
<div class="mb-4">
    <label class="block mb-1" for="title">Title</label>
    <input id="title" type="text" name="title" value="{{ old('title', $post->title ?? '') }}"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
</div>
<div class="mb-4">
    <label class="block mb-1" for="slug">Slug</label>
    <input id="slug" type="text" name="slug" value="{{ old('slug', $post->slug ?? '') }}"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
</div>
<div class="mb-4">
    <label class="block mb-1" for="image">Image</label>
    <input id="image" type="file" name="image"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
    @if(isset($post) && $post->image_url)
        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="mt-2 h-20">
    @endif
</div>
<div class="mb-4">
    <label class="block mb-1" for="content">Content</label>
    <textarea id="content" name="content" rows="5"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">{{ old('content', $post->content ?? '') }}</textarea>
</div>
<div class="mb-4">
    <label class="block mb-1" for="category_id">Category</label>
    <select id="category_id" name="category_id"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
        @foreach($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id ?? '') == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-4">
    <label class="block mb-1" for="tags">Tags</label>
    <select id="tags" name="tags[]" multiple
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}" @selected(in_array($tag->id, old('tags', isset($post) ? $post->tags->pluck('id')->toArray() : [])))>{{ $tag->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-4">
    <label class="block mb-1" for="status">Status</label>
    <select id="status" name="status"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
        <option value="draft" @selected(old('status', $post->status ?? 'draft') == 'draft')>Draft</option>
        <option value="published" @selected(old('status', $post->status ?? 'draft') == 'published')>Published</option>
    </select>
</div>
<button type="submit"
    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
    Save
</button>
