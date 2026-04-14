<x-guest-layout>
    <h5 class="fw-bold mb-4 text-center">Create Account</h5>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Name</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name') }}" required autofocus>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-person-plus me-1"></i>Register
            </button>
        </div>

        <div class="text-center">
            <a href="{{ route('login') }}" class="text-muted small">Already have an account? Log in</a>
        </div>
    </form>
</x-guest-layout>