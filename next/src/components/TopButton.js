const TopButton = ({ text, onClick }) => (
  <a
    className="btn_dark"
    style={{ margin: "10px" , background:"#6E35A0"}}
    href={onClick}
  >
    {text}
  </a>
);

export default TopButton;