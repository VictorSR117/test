SELECT Tb_banco.nome AS nome_do_banco, Tb_convenio.verba,
       MIN(Tb_contrato.data_inclusao) AS data_inclusao_do_contrato_mais_antigo,
       MAX(Tb_contrato.data_inclusao) AS data_inclusao_do_contrato_mais_recente,
       SUM(Tb_contrato.valor) AS soma_do_valor_dos_contratos
FROM Tb_contrato
INNER JOIN Tb_convenio_servico ON Tb_contrato.convenio_servico = Tb_convenio_servico.servico
INNER JOIN Tb_convenio ON Tb_convenio_servico.convenio = Tb_convenio.codigo
INNER JOIN Tb_banco ON Tb_convenio.banco = Tb_banco.codigo
GROUP BY Tb_banco.nome, Tb_convenio.verba;
