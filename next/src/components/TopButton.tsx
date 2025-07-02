const TopButton = ({ text, onClick }) => (
  <a
    className="btn_dark"
    style={{  background:"#6E35A0"}}
    href={onClick}
  >
    {text}
  </a>
);

export default TopButton;