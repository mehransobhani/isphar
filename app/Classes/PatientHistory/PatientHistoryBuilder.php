<?php

namespace App\Classes\PatientHistory;

use App\Models\PatientHistory;

class PatientHistoryBuilder
{
    public static function delete($patientId)
    {
        PatientHistory::create([
            "created_at" => createdAt(),
            "user_id" => userId(),
            "patient_id" => $patientId,
            "action" => "deleted"
        ]);
    }
    public static function update($patientId)
    {
        PatientHistory::create([
            "created_at" => createdAt(),
            "user_id" => userId(),
            "patient_id" => $patientId,
            "action" => "updated"
        ]);
    }
    public static function insert($patientId)
    {
        PatientHistory::create([
            "created_at" => createdAt(),
            "user_id" => userId(),
            "patient_id" => $patientId,
            "action" => "inserted"
        ]);
    }
    public static function dead($patientId)
    {
        PatientHistory::create([
            "created_at" => createdAt(),
            "user_id" => userId(),
            "patient_id" => $patientId,
            "action" => "dead"
        ]);
    }
    public static function tarkhis($patientId)
    {
        PatientHistory::create([
            "created_at" => createdAt(),
            "user_id" => userId(),
            "patient_id" => $patientId,
            "action" => "tarkhis"
        ]);
    }
}
