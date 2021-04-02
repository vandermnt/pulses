<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DimensionModel;
use App\QuestionModel;

class DimensionController extends Controller {

    public function index() {
        $dimensions = DimensionModel::orderBy("dimension", "asc")->get();

        return response()->json([
            "dimensions" => $dimensions
        ], 200);
    }

    public function save(Request $request) {
      $dimension = $request->input('dimension');

      $new_dimension = new DimensionModel();

      try {

          $new_dimension->dimension = $dimension;
          $new_dimension->save();
          return response()->json([
              "success" => "Dimensão salva com sucesso!"
          ], 200);

      } catch (\Throwable $error) {
          return response()->json([
              "error" => "Erro ao salvar a dimensão " . $error
          ], 500);
      }
    }

    public function update(Request $request) {
      $dimension = $request->input('dimension');
      $id_dimension = $request->input('id_dimension');

      $search_dimension = DimensionModel::find($id_dimension);

      try {

          $search_dimension->dimension = $dimension;
          $search_dimension->save();
          return response()->json([
              "success" => "Dimensão editada com sucesso!"
          ], 200);

      } catch (\Throwable $error) {
          return response()->json([
              "error" => "Erro ao salvar a dimensão " . $error
          ], 500);
      }
    }

    public function delete($id) {
      $dimension = DimensionModel::find($id);

      if ($dimension) {
          try {

              $question = QuestionModel::where('id_dimension', $id)->first();

              if($question) {
                return response()->json([
                    $question,
                      "error" => "Não foi possível excluir sua dimensão, pois há perguntas vinculadas a ela!",
                ], 401);
              }

              $dimension->delete();

              $dimensions = DimensionModel::orderBy("dimension", "asc")->get();

              return response()->json([
                  "success" => "Dimensão excluída com sucesso!",
                  "dimensions" => $dimensions
              ], 200);
          } catch (\Throwable $th) {
              return response()->json([
                  "error" => "Erro ao excluir a dimensão!",
                  $th
              ], 500);
          }
      }
      return response()->json([
          "Object not found"
      ], 200);
    }
}
