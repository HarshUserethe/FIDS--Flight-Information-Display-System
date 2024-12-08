import ArrivalDisplay from "./pages/ArrivalDisplay";
import DepartureDisplay from "./pages/DepartureDisplay"
import { HashRouter, Routes, Route} from 'react-router-dom';
import EditFlight from "./pages/EditFlight.jsx";
import EditForm from "./components/EditForm.jsx";
import EditArrivalFlight from "./components/EditArrivalFlight.jsx";
import UserAuth from "./pages/UserAuth.jsx";
import EditArrival from './pages/EditArrival.jsx';
import EditDeparture from './pages/EditDeparture.jsx';
import ProtectedRoute from "./components/ProtectedRoute.jsx";
import KioskProtection from "./components/KioskProtection.jsx";
// import BaggageClaimDisplay from "./pages/BaggageClaimDisplay.jsx";
import BeltEditForm from "./components/BeltEditForm.jsx";
import BaggageComnDisplay from './pages/BaggageComnDisplay.jsx';
import EditBaggage from "./pages/EditBaggage.jsx";
import Kiosk from "./pages/Kiosk.jsx";
import KioskUpdate from "./components/KioskUpdate.jsx";
import BeltOne from "./pages/BeltOne.jsx";
import BeltFive from "./pages/BeltFive.jsx";
import BeltTwo from "./pages/BeltTwo.jsx";
import BeltThree from "./pages/BeltThree.jsx";
import BeltFour from "./pages/BeltFour.jsx";
import CheckInDisplay from "./pages/CheckInDisplay.jsx";
import CheckInDisplayTwo from './pages/CheckInDisplayTwo.jsx';
import CheckInDisplayThree from './pages/CheckInDisplayThree.jsx';
import CheckInDisplayFour from './pages/CheckInDisplayFour.jsx';
import CheckInDisplayFive from './pages/CheckInDisplayFive.jsx';
import CheckInDisplaySix from './pages/CheckInDisplaySix.jsx';
import EditCheckIn from "./pages/EditCheckIn.jsx";
import UploadAdsFile from "./components/UploadAdsFile.jsx";
import CheckinLogin from "./pages/CheckinLogin.jsx";
import CheckinProtection from './components/CheckinProtection.jsx';
import GeneralAnnounce from "./components/GeneralAnnounce.jsx";
import Settings from "./pages/Settings.jsx";

 
const App = () => {


  return (
       <HashRouter>
     <div>
       <Routes>
         <Route path="/" element={<UserAuth />} />
         <Route path="/editbaggage" element={<ProtectedRoute Component={EditBaggage} />} />
         <Route path="/baggage-edit/:flightno/:sta/:eta/:remark/:flightcode/:delaytime/:origin/:check/:gate/:belt" element={<BeltEditForm />} />
         <Route path="/baggage-display" element={<BaggageComnDisplay />} />
         {/* <Route path="/baggage" element={<BaggageClaimDisplay /> } /> */}
         <Route path="/arrival" element={<ArrivalDisplay />} />
         <Route path="/dep" element={<DepartureDisplay/>} /> 
         <Route path="/editflight" element={<ProtectedRoute Component={EditFlight} />} />
         <Route path="/editflight/:flightno/:std/:etd/:remark/:flightcode/:delaytime/:destination/:check/:gate" element={<EditForm />} />
         <Route path="/editflightarr/:flightno/:sta/:eta/:remark/:flightcode/:delaytime/:origin/:check/:gate" element={<EditArrivalFlight />} />
        <Route path="/edit-arrival-flights" element={<ProtectedRoute Component={EditArrival} />} />
        <Route path="/edit-departure-flights" element={<ProtectedRoute Component={EditDeparture} />} />
        <Route path="/kiosk-login" element={<Kiosk />} />
        <Route path="/kiosk-update" element={<KioskProtection Component={KioskUpdate} />} />
        <Route path="/beltone" element={<BeltOne />} />
        <Route path="/belttwo" element={<BeltTwo />} />
        <Route path="/beltthree" element={<BeltThree />} />
        <Route path="/beltfour" element={<BeltFour />} />
        <Route path="/beltfive" element={<BeltFive />} />
        <Route path="/checkin-display" element={<CheckInDisplay />} />
        <Route path="/checkin-display-2" element={<CheckInDisplayTwo />} />
        <Route path="/checkin-display-3" element={<CheckInDisplayThree />} />
        <Route path="/checkin-display-4" element={<CheckInDisplayFour />} />
        <Route path="/checkin-display-5" element={<CheckInDisplayFive />} />
        <Route path="/checkin-display-6" element={<CheckInDisplaySix />} />
        <Route path="/editcheckin" element={<CheckinProtection Component={EditCheckIn} />} />
        <Route path="/uploadadv" element={<UploadAdsFile />} />
        <Route path="/checkin-login" element={<CheckinLogin />} />
        <Route path="/general-announcement" element={<ProtectedRoute Component={GeneralAnnounce} />} />
        <Route path="/settings" element={<ProtectedRoute Component={Settings} />} />
        
       </Routes>
     
     </div>
       </HashRouter>

  )
}

export default App