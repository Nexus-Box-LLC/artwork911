const Button = ({ text, onClick, className }) => (
  <a
   
    className={className}
    href={onClick}
  >
    {text}
  </a>
);

export default Button;



