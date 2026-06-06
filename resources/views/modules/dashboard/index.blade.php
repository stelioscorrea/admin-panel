<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Dashboard</h4>
        <span class="text-muted small">Bem-vindo, {{ auth()->user()->name }}</span>
    </div>

    <div class="row">
        <livewire:dashboard.metric-card
            title="Total de Usuários"
            :value="$totalUsers"
            icon="people-fill"
            color="primary"
        />
        <livewire:dashboard.metric-card
            title="Usuários Ativos"
            :value="$activeUsers"
            icon="person-check-fill"
            color="success"
        />
        <livewire:dashboard.metric-card
            title="Administradores"
            :value="$adminUsers"
            icon="shield-fill"
            color="warning"
        />
        <livewire:dashboard.metric-card
            title="Usuários Inativos"
            :value="$inactiveUsers"
            icon="person-x-fill"
            color="danger"
        />
    </div>
</div>
