<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Attribute;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    public function index()
    {
        $entities = Entity::all();
        return view('entities.index', compact('entities'));
    }

    public function create()
    {
        $attributes = Attribute::all();
        return view('entities.create', compact('attributes'));
    }

    public function store(Request $request)
    {
        $entity = Entity::create([
            'entity_type' => $request->entity_type,
        ]);

        foreach ($request->attributes as $attributeId => $value) {
            $attribute = Attribute::findOrFail($attributeId);
            $entity->attributes()->attach($attribute->id, [
                $attribute->value_type . '_value' => $value,
            ]);
        }

        return redirect()->route('entities.index')->with('success', 'Entity created successfully.');
    }

    public function edit(Entity $entity)
    {
        $attributes = Attribute::all();
        return view('entities.edit', compact('entity', 'attributes'));
    }

    public function update(Request $request, Entity $entity)
    {
        $entity->update([
            'entity_type' => $request->entity_type,
        ]);

        $entity->attributes()->detach();

        foreach ($request->attributes as $attributeId => $value) {
            $attribute = Attribute::findOrFail($attributeId);
            $entity->attributes()->attach($attribute->id, [
                $attribute->value_type . '_value' => $value,
            ]);
        }

        return redirect()->route('entities.index')->with('success', 'Entity updated successfully.');
    }

    public function destroy(Entity $entity)
    {
        $entity->attributes()->detach();
        $entity->delete();
        return redirect()->route('entities.index')->with('success', 'Entity deleted successfully.');
    }
}
