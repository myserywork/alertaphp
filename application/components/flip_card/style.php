
<style>
    
  .dashboard-title {
    font-size: 30px;
    font-weight: bold;
    text-transform: uppercase;
    color: rgba(0, 0, 0, 0.5);
    margin-bottom: 5px;
  }

  .card-container {
    cursor: pointer;
    margin-left: 15px;
    margin-bottom: 15px;
    position: relative;
    border: 1px solid rgba(0, 0, 0, 0.1);
    width: 300px;
    height: 200px;
    border-radius: 10px;
    overflow: hidden;
  }

  .card-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.3s ease;
  }

  .card-container:hover .card-image {
    transform: scale(1.1);
  }

  .card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(51, 55, 94, 0.7);
    backdrop-filter: blur(10px);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    border-radius: 10px;
    opacity: 1;
    transition: opacity 0.3s ease;
  }

  .card-container:hover .card-overlay {
    opacity: 0;
  }

  .card-text {
    font-size: 24px;
    font-weight: bold;
    color: white;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    margin-top: 10px;
    transition: color 0.3s ease;
  }

  .card-container:hover .card-text {
    color: transparent;
  }

  .card-icon {
    font-size: 48px;
    color: white;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    transition: transform 0.3s ease;
  }

  .card-container:hover .card-icon {
    transform: rotate(360deg);
  }
</style>