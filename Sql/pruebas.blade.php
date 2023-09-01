@can('admin-only')
    {{-- Contenido visible solo para administradores --}}
@endcan

@cannot('paciente-only')
    {{-- Contenido no visible para pacientes --}}
@endcannot

@php
    public function adminDashboard()
{
    $this->authorize('admin-only');

    // Lógica del controlador para el panel de administración
}
@endphp

@php
    Route::middleware(['can:admin-only'])->group(function () {
    // Rutas que solo los administradores pueden acceder
});
@endphp
