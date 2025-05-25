<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends \Illuminate\Routing\Controller
{
    // Создание заявки
    public function store(Request $request)
    {
        // Проверяем роль пользователя (только 'user' может создать заявку)
        if ($request->user()->role->name !== 'user') {
            return response()->json(['error' => 'Доступ запрещён'], 403);
        }

        // Валидация
        $validated = $request->validate([
            'from_address' => 'required|string',
            'to_address' => 'required|string',
            'description' => 'nullable|string'
        ]);

        // Создаём заявку
        $order = Order::create([
            'user_id' => $request->user()->id,
            'from_address' => $validated['from_address'],
            'to_address' => $validated['to_address'],
            'description' => $validated['description'] ?? null,
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Заявка успешно создана',
            'order' => $order
        ], 201);
    }
}