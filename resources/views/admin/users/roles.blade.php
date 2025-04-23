<form method="POST" action="{{ route('admin.users.roles.update', $user) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        @foreach($roles as $role)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" 
                       name="roles[]" value="{{ $role->name }}"
                       id="role_{{ $role->id }}"
                       {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                <label class="form-check-label" for="role_{{ $role->id }}">
                    {{ $role->name }}
                </label>
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-primary">Update Roles</button>
</form>