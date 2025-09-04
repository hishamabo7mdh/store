        @if ($errors->any())
            <div class="alert alert-danger">
                <h3>Error Occurred</h3>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
        
        <div class="from-group">
            <label for="">Category Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{   old('name', $category->name ?? '') }}">
            @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>                
            @enderror

        </div>
        <div class="from-group">
            <label for="">Category Parent</label>
            <select name="parent_id" class="form-select">
                <option value="">Primary Category</option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id ?? '') == $parent->id)>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="from-group">
            <label for="">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $category->description ?? '') }}</textarea>

        </div>


        {{-- حقل رفع صورة --}}
        <div class="form-group">
            <label for="">Image</label>
            <input type="file" name="image" class="form-control" id="imageInput" accept="image/*">
        </div>
        @if (isset($category) && $category->image)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $category->image) }}" alt="image" height="50px">
            </div>
        @endif
        <div class="from-group">
            <button type="submit" class="btn btn-primary">{{ $button_label ?? 'update' }}</button>
        </div>

        <div class="from-group">
            <label for="">status</label>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="active"
                        @checked(old('status', $category->status ?? '') == 'active')>
                    <label class="form-check-label">
                        Active
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="archived"
                        @checked(old('status', $category->status ?? '') == 'inactive')>
                    <label class="form-check-label">
                        Archived
                    </label>
                </div>
            </div>
        </div>
