<?php

// app/Models/Entrega.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    // Atributos que podem ser preenchidos em massa
    protected $fillable = [
        '_id', '_id_transportadora', '_volumes', '_remetente', '_destinatario', '_rastreamento', '_cnpj', '_fantasia',
    ];

    // Chave primária personalizada
    protected $primaryKey = '_id';

    // Indica que a chave primária não é autoincremental
    public $incrementing = false;

    // Tipo da chave primária
    protected $keyType = 'string';

    // Atributos que devem ser tratados como arrays
    protected $casts = [
        '_remetente' => 'array',
        '_destinatario' => 'array',
        '_rastreamento' => 'array',
    ];

    /**
     * Salva os dados de entrega no banco de dados.
     *
     * @param array $data
     * @return Entrega
     */
    public static function saveEntregaData(array $data)
    {
        return self::updateOrCreate(['_id' => $data['_id']], $data);
    }

    /**
     * Obtém dados de entrega do banco de dados por ID.
     *
     * @param string $id
     * @return Entrega|null
     */
    public static function getEntregaById($id)
    {
        return self::find($id);
    }

    /**
     * Obtém dados de entrega do banco de dados por CPF do destinatário.
     *
     * @param string $cpf
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getEntregasByCpf($cpf)
    {
        return self::where('_destinatario', $cpf)->get();
    }
}
