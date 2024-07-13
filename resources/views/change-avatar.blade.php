<x-layout>
    <div class="container mt-5">
        <h2>Change Avatar</h2>
        <form action='/change-avatar/{{auth()->user()->id}}' method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="avatar">Upload new avatar:</label>
                <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                @error('avatar')
                    
                <div class= "alert alert-danger">
                  <strong> error!</strong> {{$message}}
            
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Change Avatar</button>
        </form>
    </div>
</x-layout>