@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Card Profile -->
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Profil de {{ $user->firstname }}</h5>
        </div>
        <div class="card-body">
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="card-text"><strong>Téléphone:</strong> {{ $user->phone }}</p>
        </div>
        <div class="card-footer text-end">
            <!-- Button to open the modal -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profileModal">Modifier Profil</button>
        </div>
    </div>

    <!-- Modal for success message -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h5 class="modal-title" id="successModalLabel">Profil mis à jour avec succès</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for profile editing -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Modifier le Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname', $user->firstname) }}" required>
                            @error('firstname')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script pour afficher le modal de succès après la mise à jour -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var successMessage = document.body.getAttribute('data-success-message');
        if (successMessage) {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
            setTimeout(() => {
                successModal.hide();
            }, 5000); // 5 secondes
        }
    });
</script>
@endsection