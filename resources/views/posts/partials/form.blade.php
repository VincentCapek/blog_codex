@csrf
<div class="mb-4">
    <label class="block mb-1" for="title">Title</label>
    <input id="title" type="text" name="title" value="{{ old('title', $post->title ?? '') }}" class="border rounded w-full p-2">
</div>
<div class="mb-4">
    <label class="block mb-1" for="slug">Slug</label>
    <input id="slug" type="text" name="slug" value="{{ old('slug', $post->slug ?? '') }}" class="border rounded w-full p-2">
</div>
<div class="mb-4">
    <label class="block mb-1" for="content">Content</label>
    <textarea id="content" name="content" rows="5" class="border rounded w-full p-2">{{ old('content', $post->content ?? '') }}</textarea>
</div>
<div class="mb-4">
    <label class="block mb-1" for="category_id">Category</label>
    <select id="category_id" name="category_id" class="border rounded w-full p-2">
        @foreach($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id ?? '') == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-4">
    <label class="block mb-1" for="tags">Tags</label>
    <select id="tags" name="tags[]" multiple class="border rounded w-full p-2">
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}" @selected(in_array($tag->id, old('tags', isset($post) ? $post->tags->pluck('id')->toArray() : [])))>{{ $tag->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-4">
    <label class="block mb-1" for="status">Status</label>
    <select id="status" name="status" class="border rounded w-full p-2">
        <option value="draft" @selected(old('status', $post->status ?? 'draft') == 'draft')>Draft</option>
        <option value="published" @selected(old('status', $post->status ?? 'draft') == 'published')>Published</option>
    </select>
</div>
<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
