@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="fade-in">
    <!-- Dashboard Cards -->
    <div class="dashboard-cards">
        <div class="dashboard-card primary">
            <div class="card-header">
                <div class="card-title">Total Siswa</div>
                <div class="card-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>
            <div class="card-value">850</div>
        </div>
        
        <div class="dashboard-card success">
            <div class="card-header">
                <div class="card-title">Total Tenaga Pendidik</div>
                <div class="card-icon success">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
            </div>
            <div class="card-value">45</div>
        </div>
        
        <div class="dashboard-card warning">
            <div class="card-header">
                <div class="card-title">Total Fasilitas</div>
                <div class="card-icon warning">
                    <i class="fas fa-school"></i>
                </div>
            </div>
            <div class="card-value">24</div>
        </div>
        
        <div class="dashboard-card succes">
            <div class="card-header">
                <div class="card-title">Total Prestasi</div>
                <div class="card-icon bg-success">
                    <i class="fas fa-medal"></i>
                </div>
            </div>
            <div class="card-value">92</div>
        </div>
    </div>
</div>
@endsection