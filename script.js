// Função handlePhone: Esta função é chamada quando o usuário digita no campo de telefone.
const handlePhone = (event) => {
  // Obtém a referência para o elemento de entrada que acionou o evento.
  let input = event.target;

  // Aplica a máscara de telefone ao valor atual do campo.
  input.value = phoneMask(input.value);
};

// Função phoneMask: Esta função recebe um número de telefone e aplica a máscara desejada.
const phoneMask = (value) => {
  // Se o valor é vazio, retorna uma string vazia.
  if (!value) return "";

  // Remove todos os caracteres não numéricos do valor.
  value = value.replace(/\D/g, "");

  // Aplica a máscara (xx) xxxx-xxxx ao número de telefone.
  value = value.replace(/(\d{2})(\d)/, "($1) $2");
  value = value.replace(/(\d)(\d{4})$/, "$1-$2");

  // Retorna o valor com a máscara aplicada.
  return value;
};
